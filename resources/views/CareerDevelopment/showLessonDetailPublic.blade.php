<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $lesson->judul }} | {{ $class->judul }}</title>

    <link href="https://fonts.googleapis.com/css2?family=Barlow:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,600;1,700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/css/career-development.css', 'resources/js/app.js'])
</head>

<body>

    <x-navbar />

    <header class="path-header">
        <div class="path-header-inner">
            <div class="path-crumb">
                <a href="{{ route('career.index') }}">Career Development</a> /
                <a href="{{ route('career.show', $class->id) }}">{{ Str::limit($class->judul, 40) }}</a> /
                {{ Str::limit($lesson->judul, 40) }}
            </div>
            <h1>{{ $lesson->judul }}</h1>
        </div>
    </header>

    <div class="path-body lesson-body">

        <aside class="syllabus-card lesson-sidebar">

            <div class="syllabus-eyebrow">Jalur Belajar</div>

            <div class="lesson-sidebar-progress">
                <div class="card-progress-track">
                    <div class="card-progress-fill" style="width: {{ $totalLessons > 0 ? ($completedCount / $totalLessons) * 100 : 0 }}%;"></div>
                </div>
                <span class="lesson-sidebar-progress-label">{{ $completedCount }} / {{ $totalLessons }} lesson selesai</span>
            </div>

            <div class="lesson-sidebar-list">
                @foreach ($lessons as $item)
                    @if ($item->is_locked)
                        <div class="lesson-sidebar-item is-locked">
                            <span class="lesson-sidebar-dot">🔒</span>
                            <span class="lesson-sidebar-title">{{ $item->judul }}</span>
                        </div>
                    @else
                        <a href="{{ $item->url }}" class="lesson-sidebar-item {{ $item->is_current ? 'is-current' : '' }}">
                            <span class="lesson-sidebar-dot {{ $item->is_completed ? 'is-done' : '' }}">
                                {{ $item->is_completed ? '✓' : $loop->iteration }}
                            </span>
                            <span class="lesson-sidebar-title">{{ $item->judul }}</span>
                        </a>
                    @endif
                @endforeach
            </div>

            <a href="{{ route('career.show', $class->id) }}" class="lesson-sidebar-back">← Kembali ke Kelas</a>

        </aside>

        <div class="lesson-content-col">

            <div class="lesson-content-card">

                <div class="lesson-content-meta">
                    <span class="node-meta-type">{{ ucfirst($lesson->tipe_konten) }}</span>
                    @if ($lesson->durasi_menit)
                        <span>· {{ $lesson->durasi_menit }} Menit</span>
                    @endif
                    @if ($isCompleted)
                        <span class="lesson-status-badge">Sudah Diselesaikan</span>
                    @endif
                </div>

                <div class="lesson-content-body">

                    @if ($lesson->tipe_konten === 'video')

                        @if ($videoUrl)
                            <div class="lesson-video-wrap">
                                <video controls preload="metadata">
                                    <source src="{{ $videoUrl }}" type="video/mp4">
                                    Browser kamu tidak mendukung pemutaran video ini.
                                    <a href="{{ $videoUrl }}" target="_blank">Unduh video</a> untuk menontonnya secara langsung.
                                </video>
                            </div>
                        @else
                            <p class="lesson-empty-state">Video belum tersedia untuk lesson ini.</p>
                        @endif

                    @elseif ($lesson->tipe_konten === 'dokumen')

                        @if ($docUrl)
                            @if ($isPdf)
                                <div class="lesson-doc-wrap">
                                    <iframe src="{{ $docUrl }}" title="{{ $lesson->judul }}" loading="lazy"></iframe>
                                </div>
                                <a href="{{ $docUrl }}" target="_blank" class="lesson-doc-download">Buka Dokumen di Tab Baru</a>
                            @else
                                {{-- Format seperti DOC/DOCX/PPT/PPTX tidak bisa di-preview langsung di browser --}}
                                <div class="lesson-file-card">
                                    <div class="lesson-file-icon">📄</div>
                                    <div class="lesson-file-info">
                                        <span class="lesson-file-name">{{ $lesson->judul }}</span>
                                        <span class="lesson-file-type">{{ strtoupper($docExt) }}</span>
                                    </div>
                                    <a href="{{ $docUrl }}" target="_blank" class="lesson-file-download">
                                        ⬇ Unduh / Buka
                                    </a>
                                </div>
                            @endif
                        @else
                            <p class="lesson-empty-state">Dokumen belum tersedia untuk lesson ini.</p>
                        @endif

                    @else

                        <div class="lesson-article">
                            {!! $lesson->konten !!}
                        </div>

                    @endif

                </div>

            </div>

            <div class="lesson-actions">

                @if (!$isCompleted)
                    <form action="{{ route('career.lesson.complete', [$class->id, $lesson->id]) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn-enroll lesson-complete-btn">
                            {{ $nextLesson ? 'Tandai Selesai & Lanjut' : 'Tandai Selesai & Selesaikan Kelas' }}
                        </button>
                    </form>
                @elseif ($nextLesson)
                    <a href="{{ route('career.lesson.show', [$class->id, $nextLesson->id]) }}" class="btn-enroll lesson-complete-btn">
                        Lanjut ke Lesson Berikutnya
                    </a>
                @else
                    <a href="{{ route('career.show', $class->id) }}" class="btn-enroll lesson-complete-btn">
                        Kembali ke Ringkasan Kelas
                    </a>
                @endif

            </div>

        </div>

    </div>

    <x-footer />

</body>

</html>