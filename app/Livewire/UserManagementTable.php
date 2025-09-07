<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserManagementTable extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;
    public $name, $email, $password, $password_confirmation, $role, $user_id;
    public $showUserModal = false;
    public $editMode = false;

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => ['required', 'string', Rule::in(['admin', 'legal', 'marketing'])],
        ];
    }

    protected $messages = [
        'name.required' => 'Nama wajib diisi.',
        'email.required' => 'Email wajib diisi.',
        'email.email' => 'Email harus berupa alamat email yang valid.',
        'email.unique' => 'Email ini sudah terdaftar.',
        'password.required' => 'Password wajib diisi.',
        'password.min' => 'Password minimal 8 karakter.',
        'password.confirmed' => 'Konfirmasi password tidak cocok.',
        'role.required' => 'Role wajib diisi.',
        'role.in' => 'Role tidak valid.',
    ];

    public function mount()
    {
        // Set default role for new user creation
        $this->role = 'admin';
    }

    public function render()
    {
        $users = User::search($this->search)
                     ->paginate($this->perPage);

        return view('livewire.user-management-table', [
            'users' => $users,
        ]);
    }

    public function newUser()
    {
        $this->resetInputFields();
        $this->editMode = false;
        $this->showUserModal = true;
    }

    public function createUser()
    {
        $this->validate();

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'role' => $this->role,
        ]);

        session()->flash('message', 'User berhasil ditambahkan.');
        $this->showUserModal = false;
        $this->resetInputFields();
    }

    public function editUser($id)
    {
        $user = User::findOrFail($id);
        $this->user_id = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role = $user->role;
        $this->editMode = true;
        $this->showUserModal = true;
    }

    public function updateUser()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($this->user_id)],
            'password' => 'nullable|string|min:8|confirmed', // Password is optional on update
            'role' => ['required', 'string', Rule::in(['admin', 'legal', 'marketing'])],
        ];

        $this->validate($rules);

        $user = User::findOrFail($this->user_id);
        $user->update([
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role,
        ]);

        if (!empty($this->password)) {
            $user->update(['password' => Hash::make($this->password)]);
        }

        session()->flash('message', 'User berhasil diperbarui.');
        $this->showUserModal = false;
        $this->resetInputFields();
    }

    public function deleteUser($id)
    {
        User::find($id)->delete();
        session()->flash('message', 'User berhasil dihapus.');
    }

    private function resetInputFields()
    {
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->password_confirmation = '';
        $this->role = 'user'; // Reset to default
        $this->user_id = null;
    }
}