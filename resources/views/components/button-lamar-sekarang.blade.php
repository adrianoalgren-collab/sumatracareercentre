@props(['lowongan'])

{{--
    =========================================================================
    KOMPONEN: <x-button-lamar-sekarang :lowongan="$lowongan" />
    =========================================================================
    Pakai di halaman detail lowongan, gantikan tombol lama:

        <button class="btn-apply" style="margin-bottom:12px;">
            Daftar Sekarang
        </button>

    menjadi:

        <x-button-lamar-sekarang :lowongan="$lowongan" />

    Butuh (lihat file-file terpisah yang menyertai komponen ini):
    - migration tabel `lamaran` + model App\Models\Lamaran
    - relasi lamaran()/sudahDilamarOleh() di model Lowongan
    - relasi lamaran()/hasDocuments() di model User
    - App\Http\Controllers\LamaranController + route lowongan.apply
    =========================================================================
--}}

@guest
    <a href="{{ route('login', ['redirect' => url()->current()]) }}" class="btn-apply" style="margin-bottom:6px; display:block; text-align:center; text-decoration:none;">
        Daftar Sekarang
    </a>
    <p style="margin-top:6px; font-size:13px; color:#5a7480; text-align:center; margin-bottom:12px;">
        Masuk terlebih dahulu untuk melamar
    </p>
@else
    @php
        $user = auth()->user();
        $hasDocuments = $user->hasDocuments();
        $sudahMelamar = $lowongan->sudahDilamarOleh($user->id);
        $modalSuffix = $lowongan->id;
    @endphp

    @if($sudahMelamar)
        <button type="button" class="btn-apply" style="margin-bottom:12px; opacity:0.6; cursor:not-allowed;" disabled>
            Sudah Melamar
        </button>
    @elseif(!$hasDocuments)
        <button type="button" class="btn-apply" style="margin-bottom:12px;" onclick="document.getElementById('cvWarningModal-{{ $modalSuffix }}').showModal()">
            Daftar Sekarang
        </button>
    @else
        <button type="button" class="btn-apply" style="margin-bottom:12px;" onclick="document.getElementById('applyModal-{{ $modalSuffix }}').showModal()">
            Daftar Sekarang
        </button>
    @endif


    @if(!$sudahMelamar)

        {{-- ================= MODAL: DOKUMEN BELUM ADA ================= --}}

        <dialog id="cvWarningModal-{{ $modalSuffix }}" class="apply-dialog">
            <div class="apply-dialog-inner">
                <span class="material-icons-round apply-warning-icon">description</span>
                <h3 class="job-title" style="margin-top:14px;">Dokumen Belum Tersedia</h3>
                <p style="color:#5a7480; margin-top:8px; line-height:1.7;">
                    Kamu belum memiliki dokumen (CV) di profil. Upload CV terlebih dahulu, atau upload langsung saat melamar.
                </p>
                <div style="display:flex; gap:12px; margin-top:22px;">
                    <button type="button" class="btn-save-job" style="flex:1;" onclick="document.getElementById('cvWarningModal-{{ $modalSuffix }}').close(); document.getElementById('applyModal-{{ $modalSuffix }}').showModal()">
                        Lamar & Upload Sekarang
                    </button>
                    <a href="{{ route('profil.edit') }}" class="btn-apply" style="flex:1; text-align:center; text-decoration:none;">
                        Ke Profil
                    </a>
                </div>
            </div>
        </dialog>


        {{-- ================= MODAL: FORM LAMARAN ================= --}}

        <dialog id="applyModal-{{ $modalSuffix }}" class="apply-dialog apply-dialog-wide">
            <div class="apply-dialog-inner">

                <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:6px;">
                    <h3 class="job-title" style="margin:0;">Lamar Pekerjaan Ini</h3>
                    <button type="button" class="apply-close-btn" onclick="document.getElementById('applyModal-{{ $modalSuffix }}').close()">
                        <span class="material-icons-round">close</span>
                    </button>
                </div>
                <p style="color:#5a7480; font-size:14px; margin-bottom:22px;">
                    {{ $lowongan->judul_lowongan }} • {{ $lowongan->perusahaan?->nama_perusahaan }}
                </p>

                @if ($errors->any())
                    <div style="background:#fef2f2; color:#b91c1c; padding:12px 14px; border-radius:10px; margin-bottom:16px; font-size:13px;">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form action="{{ route('lowongan.apply', $lowongan->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- DATA DIRI --}}
                    <div class="apply-section-label">Data Diri</div>

                    <div class="apply-form-row">
                        <div class="apply-field">
                            <label>Nama Lengkap</label>
                            <input type="text" name="nama" value="{{ old('nama', $user->name) }}" required>
                        </div>
                        <div class="apply-field">
                            <label>Email</label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}" required>
                        </div>
                    </div>

                    <div class="apply-form-row">
                        <div class="apply-field">
                            <label>No. HP / WhatsApp</label>
                            <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" required>
                        </div>
                        <div class="apply-field">
                            <label>Alamat</label>
                            <input type="text" name="address" value="{{ old('address', $user->address) }}" required>
                        </div>
                    </div>

                    {{-- CV / DOKUMEN --}}
                    <div class="apply-section-label" style="margin-top:22px;">Curriculum Vitae (CV)</div>

                    @if($hasDocuments)
                        <div class="apply-field" style="margin-bottom:12px;">
                            <label>Pilih dokumen dari profil</label>
                            <select name="document_id">
                                @foreach($user->documents as $doc)
                                    <option value="{{ $doc->id }}">{{ $doc->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <label class="apply-cv-toggle">
                            <input type="checkbox" onchange="document.getElementById('cvUploadField-{{ $modalSuffix }}').style.display = this.checked ? 'block' : 'none'; this.closest('form').querySelector('select[name=document_id]').disabled = this.checked;">
                            Upload dokumen lain untuk lamaran ini
                        </label>
                    @else
                        <p style="font-size:13px; color:#b45309; background:#fffbeb; padding:10px 14px; border-radius:10px; margin-bottom:10px;">
                            Kamu belum punya dokumen tersimpan. Silakan upload CV di bawah ini.
                        </p>
                    @endif

                    <div class="apply-field" id="cvUploadField-{{ $modalSuffix }}" style="{{ $hasDocuments ? 'display:none;' : '' }} margin-top:10px;">
                        <input type="file" name="cv_baru" accept=".pdf,.doc,.docx" {{ $hasDocuments ? '' : 'required' }}>
                        <small style="color:#5a7480;">Format PDF/DOC, maksimal 5MB</small>
                    </div>

                    {{-- SURAT LAMARAN --}}
                    <div class="apply-section-label" style="margin-top:22px;">Surat Lamaran</div>

                    <div class="apply-field">
                        <textarea name="surat_lamaran" rows="5" placeholder="Ceritakan mengapa kamu cocok untuk posisi ini..." required>{{ old('surat_lamaran') }}</textarea>
                    </div>

                    <button type="submit" class="btn-apply" style="width:100%; margin-top:24px;">
                        Kirim Lamaran
                    </button>
                </form>

            </div>
        </dialog>

    @endif
@endguest


@once
    <style>
        .apply-dialog {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            margin: 0;
            border: none;
            border-radius: 16px;
            padding: 0;
            max-width: 420px;
            width: 90%;
            max-height: 85vh;
            box-shadow: 0 20px 60px rgba(15, 40, 50, 0.25);
        }

        .apply-dialog-wide {
            max-width: 600px;
        }

        .apply-dialog::backdrop {
            background: rgba(15, 30, 38, 0.55);
            backdrop-filter: blur(2px);
        }

        .apply-dialog-inner {
            padding: 32px;
            max-height: 85vh;
            overflow-y: auto;
        }

        /* animasi masuk yang halus, biar nggak muncul kaku */
        .apply-dialog[open] {
            animation: apply-dialog-in 0.22s ease-out;
        }

        @keyframes apply-dialog-in {
            from {
                opacity: 0;
                transform: translate(-50%, -50%) scale(0.96);
            }
            to {
                opacity: 1;
                transform: translate(-50%, -50%) scale(1);
            }
        }

        .apply-warning-icon {
            font-size: 40px;
            color: #d97706;
        }

        .apply-close-btn {
            background: none;
            border: none;
            cursor: pointer;
            color: #5a7480;
            display: flex;
            align-items: center;
        }

        .apply-section-label {
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            color: #2f8f6e;
            margin-bottom: 12px;
        }

        .apply-form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
            margin-bottom: 14px;
        }

        .apply-field {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .apply-field label {
            font-size: 13px;
            color: #334155;
            font-weight: 600;
        }

        .apply-field input[type="text"],
        .apply-field input[type="email"],
        .apply-field textarea,
        .apply-field input[type="file"],
        .apply-field select {
            padding: 10px 12px;
            border: 1px solid #dbe4e8;
            border-radius: 10px;
            font-family: inherit;
            font-size: 14px;
        }

        .apply-field textarea {
            resize: vertical;
        }

        .apply-cv-toggle {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            color: #5a7480;
            cursor: pointer;
            margin-bottom: 6px;
        }

        @media (max-width: 640px) {
            .apply-form-row {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endonce