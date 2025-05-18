<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Http\Requests\ContactRequest;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    // お問い合わせフォーム表示
    public function index()
    {
        return view('contact');
    }

    // 確認ページ表示
    public function confirm(ContactRequest $request)
    {
        $inputs = $request->all();
        return view('confirm', compact('inputs'));
    }

    // サンクスページ表示
    public function thanks(Request $request)
    {
        $fullName = $request->last_name . ' ' . $request->first_name;

        Contact::create([
            'name' => $fullName,
            'gender' => $request->gender,
            'email' => $request->email,
            'tel' => $request->tel,
            'address' => $request->address,
            'building_name' => $request->building_name,
            'category_id' => $request->category_id,
            'content' => $request->content,
        ]);

        return view('thanks');
    }

    // 管理画面表示
    public function admin(Request $request)
    {
        $query = Contact::query();

        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            $query->where(function ($q) use ($keyword) {
                $q->where('name', 'like', "%{$keyword}%")
                    ->orWhere('email', 'like', "%{$keyword}%");
            });
        }

        if ($request->filled('gender')) {
            $query->where('gender', $request->gender);
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('created_at')) {
            $query->whereDate('created_at', $request->created_at);
        }

        $contacts = $query->paginate(7);
        return view('admin', compact('contacts'));
    }

    // 削除処理
    public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect()->route('admin')->with('success', 'お問い合わせが削除されました');
    }
}
