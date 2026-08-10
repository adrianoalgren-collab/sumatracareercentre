@extends('layouts.app')

@section('content')

<div class="content-card">

    <!-- HEADER -->
    <div class="table-header">
        <div>
            <a href="{{ route('admin.career.index') }}" class="back-link" style="text-decoration:none; display:inline-flex; align-items:center; gap:6px; margin-bottom:6px;">
                <i class="fas fa-arrow-left"></i>
                <span>Kembali ke Data Career Development</span>
            </a>
            <h2 class="section-title">Kelola Lesson — {{ $class->judul }}</h2>
            <p class="section-subtitle">{{ $class->lessons_count }} Lesson &mdash; drag ikon <i class="fas fa-grip-vertical"></i> untuk ubah urutan</p>
        </div>

        <a href="{{ route('admin.career.lesson.create', $class->id) }}"
            class="btn-primary"
            style="text-decoration:none;">

            <i class="fas fa-plus"></i>
            Tambah Lesson

        </a>
    </div>

    <div id="reorder-alert" style="display:none; padding:10px 16px; border-radius:8px; margin-bottom:12px; font-size:14px;"></div>

    <div class="table-wrapper">
        <table class="modern-table">
            <thead>
                <tr>
                    <th style="width:36px;"></th>
                    <th>Urutan</th>
                    <th>Judul Lesson</th>
                    <th>Tipe Konten</th>
                    <th>Durasi</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody id="lesson-sortable-list" data-class-id="{{ $class->id }}">

                @forelse($lessons as $lesson)
                <tr data-lesson-id="{{ $lesson->id }}">
                    <td class="drag-handle" style="cursor:grab; text-align:center; color:#9aa0a6;">
                        <i class="fas fa-grip-vertical"></i>
                    </td>

                    <td class="urutan-cell">{{ $lesson->urutan }}</td>

                    <td>{{ $lesson->judul }}</td>

                    <td>
                        @if($lesson->tipe_konten == 'video')
                            <span class="badge info"><i class="fas fa-video"></i> Video</span>
                        @elseif($lesson->tipe_konten == 'artikel')
                            <span class="badge info"><i class="fas fa-file-alt"></i> Artikel</span>
                        @else
                            <span class="badge info"><i class="fas fa-file-pdf"></i> Dokumen</span>
                        @endif
                    </td>

                    <td>{{ $lesson->durasi_menit ? $lesson->durasi_menit . ' menit' : '-' }}</td>

                    <td style="display:flex; gap:8px; align-items:center;">

                        <a href="{{ route('admin.career.lesson.edit', ['classId' => $class->id, 'lessonId' => $lesson->id]) }}"
                        class="btn-icon edit"
                        title="Edit Lesson"
                        style="display:inline-flex; align-items:center; justify-content:center;">
                            <i class="fas fa-edit"></i>
                        </a>

                        <form action="{{ route('admin.career.lesson.delete', ['classId' => $class->id, 'lessonId' => $lesson->id]) }}"
                            method="POST"
                            id="form-hapus-lesson-{{ $lesson->id }}"
                            style="margin:0;">

                            @csrf
                            @method('DELETE')

                            <button type="button"
                                    class="btn-icon delete"
                                    title="Hapus Lesson"
                                    onclick="konfirmasiHapus('form-hapus-lesson-{{ $lesson->id }}')"
                                    style="display:inline-flex; align-items:center; justify-content:center;">
                                <i class="fas fa-trash"></i>
                            </button>

                        </form>

                    </td>
                </tr>

                @empty
                <tr>
                    <td colspan="6" style="text-align:center;padding:30px;">
                        Belum ada lesson di kelas ini
                    </td>
                </tr>
                @endforelse

            </tbody>
        </table>
    </div>

</div>

<x-modal-success />
<x-modal-konfirmasi-hapus />

@endsection

<style>
    .badge.info {
        background: #e3f2fd;
        color: #1976d2;
    }

    .back-link {
        font-size: 13px;
        font-weight: 500;
        color: #607d8b;
        transition: color 0.15s ease, gap 0.15s ease;
    }

    .back-link i {
        font-size: 12px;
        transition: transform 0.15s ease;
    }

    .back-link:hover {
        color: #1976d2;
    }

    .back-link:hover i {
        transform: translateX(-3px);
    }

    .sortable-ghost {
        opacity: 0.4;
        background: #f1f3f5;
    }

    .sortable-chosen {
        background: #eef6ff;
    }
</style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.2/Sortable.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const list = document.getElementById('lesson-sortable-list');

        if (!list || list.querySelectorAll('tr[data-lesson-id]').length === 0) {
            return;
        }

        const classId = list.dataset.classId;
        const alertBox = document.getElementById('reorder-alert');

        function showAlert(message, isError) {
            alertBox.textContent = message;
            alertBox.style.display = 'block';
            alertBox.style.background = isError ? '#f8d7da' : '#d1e7dd';
            alertBox.style.color = isError ? '#842029' : '#0f5132';
            alertBox.style.border = '1px solid ' + (isError ? '#f5c2c7' : '#badbcc');

            setTimeout(function () {
                alertBox.style.display = 'none';
            }, 3000);
        }

        function renumberRows() {
            list.querySelectorAll('tr[data-lesson-id]').forEach(function (row, index) {
                row.querySelector('.urutan-cell').textContent = index + 1;
            });
        }

        Sortable.create(list, {
            handle: '.drag-handle',
            animation: 150,
            ghostClass: 'sortable-ghost',
            chosenClass: 'sortable-chosen',
            onEnd: function () {
                const lessonIds = Array.from(
                    list.querySelectorAll('tr[data-lesson-id]')
                ).map(function (row) {
                    return parseInt(row.dataset.lessonId, 10);
                });

                const reorderUrl = '{{ url("admin/career-development") }}/' + classId + '/lesson/reorder';

                fetch(reorderUrl, {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    },
                    body: JSON.stringify({ lesson_ids: lessonIds }),
                })
                    .then(function (response) {
                        if (!response.ok) {
                            throw new Error('Gagal menyimpan urutan (status ' + response.status + ')');
                        }
                        return response.json();
                    })
                    .then(function () {
                        renumberRows();
                        showAlert('Urutan lesson berhasil diperbarui.', false);
                    })
                    .catch(function (err) {
                        showAlert(err.message || 'Gagal menyimpan urutan lesson.', true);
                    });
            },
        });
    });
</script>