<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    public function form()
    {
        $categories = Category::all();
        return view('contact.form', compact('categories'));
    }

    public function confirm(ContactRequest $request)
    {
        $contact = $request->only(['last_name', 'first_name', 'gender', 'email', 'tel1', 'tel2', 'tel3', 'address', 'building', 'category_id', 'detail']);
        $category = Category::find($contact['category_id']);
        return view('contact.confirm', compact('contact', 'category'));
    }



    public function thanks(Request $request)
    {
        if ($request->has('send')) {
            $contact = $request->only(['last_name', 'first_name', 'gender', 'email', 'tel1', 'tel2', 'tel3', 'address', 'building', 'category_id', 'detail']);
            Contact::create($contact);
            return view('contact.thanks');
        } elseif ($request->has('fix')) {
            return redirect('/');
        }
    }


    
    public function admin(Request $request)
    {

        if ($request->has('reset')) {
            return redirect()->route('admin.index');
        }
        // $contact = Contact::with('category')->Paginate(7);
        // $categories = Category::all();
        $query = Contact::with('category');

        // $keyword = $request->input('input', '');
        $gender = $request->input('gender');
        $kind = $request->input('category_id');
        $date = $request->input('date');


        if ($request->filled('input')) {
            $keyword = $request->input('input'); //検索キーワードの取得
            $query->where(function ($q) use ($keyword) {
                $q->where('last_name', 'LIKE', "%{$keyword}%")
                    ->orWhere('first_name', 'LIKE', "%{$keyword}%")
                    ->orWhere('email', 'LIKE', "%{$keyword}%")
                    ->orWhere('email', $keyword)
                    ->orWhereRaw("CONCAT(last_name, first_name) = ?", [$keyword]);
            });
        }
        if (!empty($gender)) {   //性別検索
            $query->where('gender', $gender);
        }

        if (!empty($kind)) {    //お問い合わせの種類検索
            $query->where('category_id', $kind);
        }

        if (!empty($date)) {
            $query->whereDate('created_at', $date);
        }



        $contacts = $query->paginate(7);
        $categories = Category::all();

        return view('admin.index', compact('contacts', 'categories', 'gender', 'kind'));
    }
}
