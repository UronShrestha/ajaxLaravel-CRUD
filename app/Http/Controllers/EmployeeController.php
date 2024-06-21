<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/images', $filename);

            $empData = [
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'address' => $request->input('address'),
                'position' => $request->input('position'),
                'avatar' => $filename
            ];

            Employee::create($empData);

            return response()->json(['status' => 200]);
        }

        return response()->json(['status' => 400, 'message' => 'Image upload failed']);
    }

    public function fetchAll()
    {
        $emps = Employee::all();
        $output = '';

        if ($emps->count() > 0) {
            $output = '
                <table id="table" class="table table-bordered table-striped table-sm text-center align middle">
                    <thead>
                        <tr>
                            <th>Employee ID</th>
                            <th>Avatar</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Position</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>';

            foreach ($emps as $emp) {
                $output .= '
                    <tr>
                        <td>' . $emp->id . '</td>
                        <td><img src="' . asset('storage/images/' . $emp->avatar) . '" alt="Avatar" class="img-circle img-fluid" width="50px" height="50px"></td>
                        <td>' . $emp->name . '</td>
                        <td>' . $emp->email . '</td>
                        <td>' . $emp->phone . '</td>
                        <td>' . $emp->address . '</td>
                        <td>' . $emp->position . '</td>
                        <td>
                            <a href="#" id="' . $emp->id . '" class="text-success mx-1 editIcon" data-bs-toggle="modal" data-bs-target="#editEmployeeModal">
                                <i class="bi-pencil-square h4"></i>
                            </a>
                            <a href="#" id="' . $emp->id . '" class="text-danger mx-1 deleteIcon">
                                <i class="bi-trash h4"></i>
                            </a>
                        </td>
                    </tr>';
            }

            $output .= '</tbody></table>';
        } else {
            $output = '<h1 class="text-center text-secondary">No data found!</h1>';
        }

        echo $output;
    }
    //Handle edit employee ajax request
    public function edit(Request $request)
    {
        $id = $request->id;
        $emp = Employee::find($request->id);
        return response()->json($emp);
    }

    // handle update an employee ajax request
    public function update(Request $request)
    {
        //  dd($request->all());
        $fileName = '';
        $emp = Employee::find($request->id);

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/images', $fileName);
            if ($emp->avatar) {
                Storage::delete('public/images/' . $emp->avatar);
            }
        } else {
            $fileName = $request->emp_avatar;
        }

        $empData = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'post' => $request->post,
            'address' => $request->address,
            'avatar' => $fileName
        ];

        $emp->update($empData);
        return response()->json([
            'status' => 200,
        ]);
    }
    // handle delete an employee ajax request
    public function delete(Request $request)
    {
        $emp = Employee::find($request->id);
        if (Storage::delete('public/images/' . $emp->avatar)) {
            $emp->delete();
        }
    }
}
