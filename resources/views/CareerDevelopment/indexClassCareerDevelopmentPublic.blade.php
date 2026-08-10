<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $class->judul }} | Career Development</title>

    <link href="https://fonts.googleapis.com/css2?family=Barlow:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,600;1,700&display=swap" rel="stylesheet"/>

    @vite(['resources/css/app.css', 'resources/css/career-development.css', 'resources/js/app.js'])
</head>

<body>

    <x-navbar />

    <header class="path-header">
        <div class="path-header-inner">
            <div class="path-crumb">
                <a href="{{ route('career.index') }}">Career Development</a> / {{ Str::limit($class->judul, 40) }}
            </div>
            <h1>{{ $class->judul }}</h1>
            <p>{{ $class->deskripsi }}</p>
        </div>
    </header>

    <div class="path-body">

        <aside class="syllabus-card">

            @if(!$enrollment)

                <div class="syllabus-eyebrow">Mulai Belajar</div>

                <p class="syllabus-desc" style="border-bottom:none; padding-bottom:0; margin-bottom:20px;">
                    Daftar untuk membuka lesson pertama dan mulai lacak progresmu di kelas ini.
                </p>

                <div class="syllabus-stats">
                    <div>
                        <span class="syllabus-stat-num">{{ $totalLessons }}</span>
                        <span class="syllabus-stat-label">Lesson</span>
                    </div>
                </div>

                <form action="{{ route('career.enroll', $class->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-enroll">Daftar Kelas Ini</button>
                </form>

            @else

                <div class="syllabus-eyebrow">
                    {{ $enrollment->status === 'selesai' ? 'Kelas Selesai' : 'Sedang Berjalan' }}
                </div>

                <div class="progress-ring-wrap">
                    <svg width="64" height="64" viewBox="0 0 64 64">
                        <circle cx="32" cy="32" r="{{ $ring['radius'] }}" fill="none" stroke="rgba(0,75,95,0.1)" stroke-width="6" />
                        <circle cx="32" cy="32" r="{{ $ring['radius'] }}" fill="none" stroke="#0080a0" stroke-width="6"
                            stroke-linecap="round" stroke-dasharray="{{ $ring['circumference'] }}" stroke-dashoffset="{{ $ring['offset'] }}"
                            transform="rotate(-90 32 32)" />
                    </svg>
                    <div class="progress-ring-label">
                        <span class="progress-ring-num">{{ $progressPercent }}%</span>
                        <span class="progress-ring-sub">{{ $completedCount }} / {{ $totalLessons }} lesson</span>
                    </div>
                </div>

                <p class="syllabus-desc">{{ $class->deskripsi }}</p>

            @endif

        </aside>

        <div class="path-rail-col">

            <div class="path-section-label">Jalur Belajar</div>

            @if($lessons->isEmpty())

                <div class="empty-state">Belum ada lesson untuk kelas ini.</div>

            @else

                <div class="rail">
                    <div class="rail-track">
                        <div class="rail-track-fill" style="height: {{ $railStats['fill_percent'] }}%;"></div>
                    </div>

                    @foreach($lessons as $lesson)

                        <div class="lesson-node {{ $lesson->is_locked ? 'is-locked' : '' }}">
                            <div class="node-marker">
                                <div class="node-dot {{ $lesson->is_completed ? 'is-done' : ($lesson->is_locked ? 'is-locked' : 'is-active') }}">
                                    @if($lesson->is_completed)
                                        ✓
                                    @elseif($lesson->is_locked)
                                        🔒
                                    @else
                                        {{ $loop->iteration }}
                                    @endif
                                </div>
                            </div>

                            <div class="node-card">
                                <div class="node-info">
                                    <div class="node-title">{{ $lesson->judul }}</div>
                                    <div class="node-meta">
                                        <span class="node-meta-type">{{ ucfirst($lesson->tipe_konten) }}</span>
                                        @if($lesson->durasi_menit)
                                            <span>· {{ $lesson->durasi_menit }} Menit</span>
                                        @endif
                                    </div>
                                </div>

                                @if($lesson->is_locked)
                                    <span class="node-action locked">Terkunci</span>
                                @elseif($lesson->is_completed)
                                    <a href="{{ $lesson->url }}" class="node-action done">Lihat Lagi</a>
                                @else
                                    <a href="{{ $lesson->url }}" class="node-action primary">Mulai</a>
                                @endif
                            </div>
                        </div>

                    @endforeach

                    <div class="lesson-node rail-end">
                        <div class="node-marker">
                            <div class="node-dot rail-end-dot {{ $railStats['is_course_completed'] ? 'is-done' : 'is-locked' }}">
                                @if($railStats['is_course_completed'])
                                    🏁
                                @else
                                    🔒
                                @endif
                            </div>
                        </div>

                        <div class="node-card">
                            <div class="node-title {{ $railStats['is_course_completed'] ? 'is-complete-text' : '' }}">
                                {{ $railStats['is_course_completed'] ? 'Kelas Selesai' : 'Selesaikan Semua Materi' }}
                            </div>
                        </div>
                    </div>
                </div>

            @endif

        </div>

    </div>

    <x-footer />

</body>

</html>