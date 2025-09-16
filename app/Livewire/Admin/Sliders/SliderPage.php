<?php

namespace App\Livewire\Admin\Sliders;

use App\Models\HeroSlider;
use Illuminate\Support\Facades\Storage; // <-- Import Storage
use Livewire\Component;
use Livewire\WithFileUploads; // <-- Import WithFileUploads
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;

#[Layout('components.layouts.admin')]
class SliderPage extends Component
{
    use WithPagination;
    use WithFileUploads; // <-- Gunakan trait ini

    // Ganti rule image_url menjadi 'image'
    #[Rule('nullable|image|max:2048')] // Validasi untuk file gambar, max 2MB
    public $image_url;

    #[Rule('nullable|string|max:255')]
    public $title;
    #[Rule('nullable|string|max:255')]
    public $subtitle;
    #[Rule('boolean')]
    public $is_active = true;
    
    // Properti untuk menampilkan preview gambar lama saat edit
    public $existing_image_url;

    public $sliderId;
    public bool $isModalOpen = false;

    public function create() { 
        $this->reset(); 
        $this->isModalOpen = true; 
    }
    
    public function closeModal() { 
        $this->isModalOpen = false; 
        $this->reset(); 
    }

    public function edit($id)
    {
        $slider = HeroSlider::findOrFail($id);
        $this->sliderId = $id;
        $this->existing_image_url = $slider->image_url; // Simpan path gambar lama
        $this->title = $slider->title;
        $this->subtitle = $slider->subtitle;
        $this->is_active = $slider->is_active;
        $this->isModalOpen = true;
    }

    public function save()
    {
        // Tambahkan rule 'required' khusus saat membuat slider baru
        $rules = [
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'is_active' => 'boolean',
        ];

        if ($this->sliderId) {
            // Saat edit, gambar tidak wajib di-upload ulang
            $rules['image_url'] = 'nullable|image|max:2048';
        } else {
            // Saat create, gambar wajib
            $rules['image_url'] = 'required|image|max:2048';
        }
        $this->validate($rules);

        $data = $this->only(['title', 'subtitle', 'is_active']);

        // Logika untuk menangani upload file
        if ($this->image_url) {
            // Hapus gambar lama jika ada
            if ($this->sliderId && $this->existing_image_url) {
                Storage::disk('public')->delete(str_replace('/storage/', '', $this->existing_image_url));
            }
            // Simpan gambar baru dan dapatkan path-nya
            $path = $this->image_url->store('sliders', 'public');
            // Simpan path yang bisa diakses publik ke database
            $data['image_url'] = Storage::url($path);
        }

        HeroSlider::updateOrCreate(['id' => $this->sliderId], $data);
        session()->flash('message', $this->sliderId ? 'Slider berhasil diperbarui.' : 'Slider berhasil ditambahkan.');
        $this->closeModal();
    }

    public function delete($id)
    {
        $slider = HeroSlider::findOrFail($id);
        // Hapus file gambar dari storage
        if ($slider->image_url) {
            Storage::disk('public')->delete(str_replace('/storage/', '', $slider->image_url));
        }
        $slider->delete();
        session()->flash('message', 'Slider berhasil dihapus.');
    }

    public function render()
    {
        return view('livewire.admin.sliders.slider-page', [
            'sliders' => HeroSlider::latest()->paginate(5)
        ]);
    }
}