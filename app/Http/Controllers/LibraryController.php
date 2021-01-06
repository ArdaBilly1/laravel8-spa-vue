<?php

namespace App\Http\Controllers;

use App\Http\Requests\LibraryListRequest;
use App\Http\Requests\UploadFileRequest;
use App\Http\Resources\BookFileResource;
use App\Http\Resources\MasterListResource;
use App\Models\ImageBookFile;
use App\Models\Library;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class LibraryController extends Controller
{
   
    public function index()
    {
        $model = Library::get();

        return  DataTables::of(MasterListResource::collection($model->load('imageBookFiles')))->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(LibraryListRequest $request)
    {
        $model = Library::create($request->validated());

        $this->responseCode = 200;
        $this->responseMessage = 'Data berhasil disimpan';
        $this->responseData = $model;

        return response()->json($this->getResponse(), $this->responseCode);
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Library $library)
    {
        return new MasterListResource($library->load('imageBookFiles'));
    }

    public function getTop3()
    {
        $model = Library::take(3)->get();

        return  DataTables::of(MasterListResource::collection($model->load('imageBookFiles')))->toJson();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LibraryListRequest $request, Library $library)
    {
        $library->update($request->validated());

        $this->responseCode = 200;
        $this->responseMessage = 'Data berhasil diubah';
        $this->responseData = $library;

        return response()->json($this->getResponse(), $this->responseCode);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Library $library)
    {
        $library->delete();

        $this->responseCode = 200;
        $this->responseMessage = 'Data berhasil dihapus';
        $this->responseData = $library;

        return response()->json($this->getResponse(), $this->responseCode);
    }


    // ! filee

    public function uploadFiles(UploadFileRequest $request, Library $library)
    {
        $request->validated();

        $file = $request->file('file');

        $receiptFile = ImageBookFile::where('library_id', $library->id);

        $directory = 'library-files/' . $library->id;
        $changedName = time() . random_int(100, 999) . $file->getClientOriginalName();

        $is_image = false;
        if (substr($file->getClientMimeType(), 0, 5) == 'image') {
            $is_image = true;
        }

        $file->storeAs($directory, $changedName);

        $receiptFile->updateOrCreate(
            ['library_id' => $library->id],
            [
                'name'              => $changedName,
                'path'              => Storage::url('app/' . $directory . '/' . $changedName),
                'size'              => $file->getSize(),
                'ext'               => $file->getClientOriginalExtension(),
                'is_image'          => $is_image,
            ]
        );

        $file = ImageBookFile::where('library_id', $library->id)
            ->get();

        $this->responseCode = 200;
        $this->responseMessage = 'Berkas berhasil diunggah';
        $this->responseData = $file;

        return response()->json($this->getResponse(), $this->responseCode);
    }



    public function showFiles($id)
    {
        $libraryFile = ImageBookFile::where('name', $id)->first();
        $path = base_path() . $libraryFile->path;
        if (!File::exists($path)) {
            return abort(404);
        }

        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($file, 200);
        return $response->header('Content-Type', $type);

        // return $response = $path;
    }

    public function listFiles(Library $library)
    {
        $bookFile = ImageBookFile::where('library', $library->id)->get();

        $this->responseCode = 200;
        $this->responseData = BookFileResource::collection($bookFile);

        return response()->json($this->getResponse(), $this->responseCode);
    }

    public function destroyFiles($id)
    {
        $imageBookFile = ImageBookFile::find($id);
        $path = base_path() . $imageBookFile->path;
        unlink($path);
        $imageBookFile->delete();

        $this->responseCode = 200;
        $this->responseMessage = 'Berkas berhasil dihapus';

        return response()->json($this->getResponse(), $this->responseCode);
    }
}
