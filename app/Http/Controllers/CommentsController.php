<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Http\Requests;

use App\Comments;

use App\Documents;

class CommentsController extends Controller
{
    public function postComment(Request $request, $id_document, $name_without_sign)
    {
    	$comment = new Comments;
    	if ($request->content != "")
    	{
    		$comment->content = $request->content;
    		$comment->id_user = Auth::user()->id;
    		$comment->id_document = $id_document;

    		$comment->save();
    		return redirect('document/'.$id_document.'/'.$name_without_sign);
    	}
    }

    public function delComment($id, $id_document)
    {
        $comment = Comments::find($id);
        $document = Documents::find($id_document);
        $comment->delete();
        return redirect('document/'.$id_document.'/'.$document->name_without_sign);
    }
}
