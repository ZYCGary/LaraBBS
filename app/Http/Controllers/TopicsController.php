<?php

namespace App\Http\Controllers;

use App\Handlers\ImageUploadHandler;
use App\Models\Topic;
use Illuminate\Http\Request;
use App\Http\Requests\TopicRequest;
use App\Models\Category;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;

class TopicsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    public function index(Request $request, Topic $topic)
    {
        $topics = $topic->withOrder($request->input('order'))->with('user', 'category')->paginate(30);
        return view('topics.index', compact('topics'));
    }

    public function show(Request $request,Topic $topic)
    {
        // Fix URL with slug included
        if ( ! empty($topic->slug) && $topic->slug != $request->input('slug')) {
            return redirect($topic->link(), 301);
        }

        return view('topics.show', compact('topic'));
    }

    public function create(Topic $topic)
    {
        $categories = Category::all();
        return view('topics.create_and_edit', compact('topic', 'categories'));
    }

    public function store(TopicRequest $request, Topic $topic)
    {
        $topic->fill($request->all());
        $topic->user_id = Auth::id();
        $topic->save();

        return redirect()->to($topic->link())->with('success', 'Your topic is created successfully!');
    }

    public function edit(Topic $topic)
    {
        $this->authorize('update', $topic);
        $categories = Category::all();

        return view('topics.create_and_edit', compact('topic', 'categories'));
    }

    public function update(TopicRequest $request, Topic $topic)
    {
        $this->authorize('update', $topic);
        $topic->update($request->all());

        return redirect()->to($topic->link())->with('success', 'Updated successfully.');
    }

    public function destroy(Topic $topic)
    {
        $this->authorize('destroy', $topic);
        $topic->delete();

        return redirect()->route('topics.index')->with('message', 'Deleted successfully.');
    }

    /**
     * @param Request $request
     * @param ImageUploadHandler $uploader
     * @return array
     */
    public function uploadImage(Request $request, ImageUploadHandler $uploader)
    {
        // Initialise return data, default is upload fails.
        $data = [
            'success' => false,
            'msg' => 'Upload fails!',
            'file_path' => ''
        ];
        // Check whether there are images need to be uploaded.
        if ($file = $request->input('upload_file')) {

            // Save image under public\uploads\images\topics
            /** @var UploadedFile $file */
            $result = $uploader->save($file, 'topics', Auth::id(), 1024);
            // return upload success data
            if ($result) {
                $data['file_path'] = $result['path'];
                $data['msg'] = "Upload success!";
                $data['success'] = true;
            }
        }
        return $data;
    }
}
