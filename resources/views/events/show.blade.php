@extends('layouts.app')

@section('title', __('Detail of Events'))

@push('styles')
    <style>
        .card {
            border-radius: 15px;
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15) !important;
        }

        .card-header {
            border-radius: 15px 15px 0 0 !important;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
            color: white !important;
            border: none !important;
            padding: 1rem 1.5rem;
        }

        .card-header h6 {
            color: white !important;
            font-weight: 600;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .card-body {
            padding: 1.5rem;
        }

        .table-responsive {
            border-radius: 10px;
            overflow: hidden;
        }

        .table-striped>tbody>tr:nth-of-type(odd)>td {
            background-color: rgba(0, 0, 0, 0.02);
        }

        .template-image,
        .poster-image {
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .template-image:hover,
        .poster-image:hover {
            transform: scale(1.05);
        }

        .search-container {
            position: relative;
        }

        .search-loader {
            position: absolute;
            right: 50px;
            top: 50%;
            transform: translateY(-50%);
            display: none;
        }

        .spinner {
            width: 20px;
            height: 20px;
            border: 2px solid #f3f3f3;
            border-top: 2px solid #667eea;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .search-result {
            border-radius: 10px;
            padding: 0;
            margin-top: 1rem;
        }

        .result-success {
            background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
            color: white;
            border-radius: 10px;
            padding: 1.5rem;
        }

        .result-error {
            background: linear-gradient(135deg, #ff6b6b 0%, #ee5a24 100%);
            color: white;
            border-radius: 10px;
            padding: 1.5rem;
            text-align: center;
        }

        .result-info-item {
            margin-bottom: 12px;
            display: flex;
            flex-direction: column;
        }

        .result-label {
            font-size: 0.85rem;
            opacity: 0.9;
            margin-bottom: 4px;
        }

        .result-value {
            font-weight: 600;
            font-size: 1rem;
        }

        .btn-search {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 0 8px 8px 0;
            color: white;
            transition: all 0.3s ease;
        }

        .btn-search:hover {
            background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
            color: white;
            transform: scale(1.05);
        }

        .form-control {
            border-radius: 8px 0 0 8px;
            border: 2px solid #e0e6ed;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }

        .back-btn {
            background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
            border: none;
            color: #333;
            border-radius: 25px;
            padding: 10px 25px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .back-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            color: #333;
        }

        .page-title h3 {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-weight: 700;
        }

        .alert {
            border-radius: 10px;
            border: none;
        }

        .alert-info {
            background: linear-gradient(135deg, #74b9ff 0%, #0984e3 100%);
            color: white;
        }
    </style>
@endpush

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-8 order-md-1 order-last">
                    <h3><i class="fas fa-calendar-alt me-2"></i>{{ __('Events') }}</h3>
                    <p class="text-subtitle text-muted">
                        {{ __('Detail of event and participant management.') }}
                    </p>
                </div>
                <x-breadcrumb>
                    <li class="breadcrumb-item">
                        <a href="/"><i class="fas fa-home me-1"></i>{{ __('Dashboard') }}</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('events.index') }}">{{ __('Events') }}</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        {{ __('Detail') }}
                    </li>
                </x-breadcrumb>
            </div>
        </div>

        <section class="section">
            <div class="row">
                {{-- Left: Detail Event --}}
                <div class="col-lg-7 mb-4">
                    <div class="card shadow-lg border-0">
                        <div class="card-header">
                            <h6 class="mb-0">
                                <i class="fas fa-info-circle"></i>
                                {{ __('Event Details') }}
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle">
                                    <tr>
                                        <td class="fw-bold text-muted" style="width: 35%;">
                                            {{ __('Nama Event') }}
                                        </td>
                                        <td class="fw-semibold">{{ $event->nama_event }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold text-muted">
                                            {{ __('Tanggal Mulai') }}
                                        </td>
                                        <td>{{ $event->tanggal_mulai?->format('d M Y, H:i') ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold text-muted">
                                            {{ __('Tanggal Selesai') }}
                                        </td>
                                        <td>{{ $event->tanggal_selesai?->format('d M Y, H:i') ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold text-muted">
                                            {{ __('Template Sertifikat') }}
                                        </td>
                                        <td>
                                            <img src="{{ $event->template_sertifikat }}" alt="Template Sertifikat"
                                                class="template-image border"
                                                style="object-fit: cover; width: 350px; height: 200px; cursor: pointer;"
                                                data-bs-toggle="modal" data-bs-target="#templateModal">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold text-muted">
                                            {{ __('Nama NCS') }}
                                        </td>
                                        <td>{{ $event->nama_ncs }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold text-muted">
                                            {{ __('Callsign NCS') }}
                                        </td>
                                        <td>
                                            {{ $event->callsign_ncs }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold text-muted">
                                            {{ __('Poster') }}
                                        </td>
                                        <td>
                                            <img src="{{ $event->poster }}" alt="Poster" class="poster-image border"
                                                style="object-fit: cover; width: 350px; height: 200px; cursor: pointer;"
                                                data-bs-toggle="modal" data-bs-target="#posterModal">
                                        </td>
                                    </tr>
                                </table>

                            </div>
                            <div class="mt-4">
                                <a href="{{ route('events.index') }}" class="btn back-btn">
                                    <i class="fas fa-arrow-left me-2"></i>{{ __('Back to Events') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Right: Search + List Peserta --}}
                <div class="col-lg-5">
                    {{-- Search Callsign --}}
                    <div class="card shadow-lg border-0 mb-4">
                        <div class="card-header">
                            <h6 class="mb-0">
                                <i class="fas fa-search"></i>
                                {{ __('Search Callsign') }}
                            </h6>
                        </div>
                        <div class="card-body">
                            <form id="searchCallsignForm">
                                <div class="search-container">
                                    <div class="input-group">
                                        <input type="text" name="callsign" id="callsign" class="form-control"
                                            placeholder="Enter Callsign (e.g., JZ12APB)" autocomplete="off" required>
                                        <button class="btn btn-search" type="submit">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                    <div class="search-loader">
                                        <div class="spinner"></div>
                                    </div>
                                </div>
                            </form>

                            <div id="searchResult" class="search-result"></div>
                        </div>
                    </div>

                    {{-- List Peserta --}}
                    <div class="card shadow-lg border-0">
                        <div class="card-header">
                            <h6 class="mb-0">
                                <i class="fas fa-users"></i>
                                {{ __('Participants List') }}
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="text-center text-muted">
                                <i class="fas fa-user-plus fa-3x mb-3 opacity-25"></i>
                                <p>{{ __('Participant management feature will be implemented here.') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    {{-- Template Modal --}}
    <div class="modal fade" id="templateModal" tabindex="-1" aria-labelledby="templateModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="templateModalLabel">{{ __('Template Sertifikat') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img src="{{ $event->template_sertifikat }}" class="img-fluid rounded" alt="Template Sertifikat">
                </div>
            </div>
        </div>
    </div>

    {{-- Poster Modal --}}
    <div class="modal fade" id="posterModal" tabindex="-1" aria-labelledby="posterModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="posterModalLabel">{{ __('Event Poster') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img src="{{ $event->poster }}" class="img-fluid rounded" alt="Poster">
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#searchCallsignForm').on('submit', function(e) {
                e.preventDefault();

                const callsign = $('#callsign').val().trim().toUpperCase();
                const $loader = $('.search-loader');
                const $result = $('#searchResult');
                const $submitBtn = $('.btn-search');

                if (!callsign) {
                    showError('Please enter a callsign');
                    return;
                }

                // Show loading state
                $loader.show();
                $submitBtn.prop('disabled', true);
                $result.empty();

                // Make AJAX request
                $.ajax({
                    url: `https://iar-ikrap.postel.go.id/registrant/searchDataIar/`,
                    method: 'GET',
                    data: {
                        callsign: callsign
                    },
                    timeout: 10000,
                    success: function(response) {
                        handleSearchResponse(response, callsign);
                    },
                    error: function(xhr, status, error) {
                        console.error('Search error:', error);
                        if (status === 'timeout') {
                            showError('Request timeout. Please try again.');
                        } else {
                            showError(
                                'Connection error. Please check your internet connection and try again.'
                                );
                        }
                    },
                    complete: function() {
                        $loader.hide();
                        $submitBtn.prop('disabled', false);
                    }
                });
            });

            function handleSearchResponse(response, callsign) {
                const $result = $('#searchResult');

                // Check if response contains "not-found.png" or similar indicators
                if (typeof response === 'string' &&
                    (response.includes('not-found.png') || response.includes('text-center'))) {
                    showNotFound(callsign);
                    return;
                }

                // Check if response contains actual data
                if (typeof response === 'string' && response.includes('none-style')) {
                    parseAndDisplayResult(response);
                } else {
                    showNotFound(callsign);
                }
            }

            function parseAndDisplayResult(htmlResponse) {
                const $result = $('#searchResult');
                const $temp = $('<div>').html(htmlResponse);
                const $list = $temp.find('ul.none-style');

                if ($list.length === 0) {
                    showNotFound($('#callsign').val());
                    return;
                }

                let resultHtml = '<div class="result-success">';
                resultHtml += '<div class="d-flex align-items-center mb-3">';
                resultHtml += '<i class="fas fa-check-circle fa-2x me-3"></i>';
                resultHtml += '<div>';
                resultHtml += '<h6 class="mb-0">Callsign Found!</h6>';
                resultHtml += '<small class="opacity-75">Data retrieved from IAR Database</small>';
                resultHtml += '</div>';
                resultHtml += '</div>';

                $list.find('li').each(function() {
                    const $item = $(this);
                    const $titleMeta = $item.find('.title-meta');
                    const $metaDetails = $item.find('.meta-details');

                    if ($titleMeta.length && $metaDetails.length) {
                        const title = $titleMeta.text().trim();
                        const value = $metaDetails.text().trim();

                        resultHtml += '<div class="result-info-item">';
                        resultHtml += `<div class="result-label">${title}</div>`;
                        resultHtml += `<div class="result-value">${value}</div>`;
                        resultHtml += '</div>';
                    }
                });

                resultHtml += '</div>';

                $result.html(resultHtml).hide().fadeIn(500);
            }

            function showNotFound(callsign) {
                const $result = $('#searchResult');
                const resultHtml = `
            <div class="result-error">
                <i class="fas fa-exclamation-triangle fa-3x mb-3"></i>
                <h6>Callsign Not Found</h6>
                <p class="mb-0">The callsign <strong>${callsign}</strong> was not found in the IAR database.</p>
                <small class="opacity-75 mt-2 d-block">Please check the spelling and try again.</small>
            </div>
        `;

                $result.html(resultHtml).hide().fadeIn(500);
            }

            function showError(message) {
                const $result = $('#searchResult');
                const resultHtml = `
            <div class="result-error">
                <i class="fas fa-times-circle fa-2x mb-3"></i>
                <h6>Search Error</h6>
                <p class="mb-0">${message}</p>
            </div>
        `;

                $result.html(resultHtml).hide().fadeIn(500);
            }

            // Auto-uppercase callsign input
            $('#callsign').on('input', function() {
                this.value = this.value.toUpperCase();
            });

            // Clear result when input is cleared
            $('#callsign').on('keyup', function() {
                if (!this.value.trim()) {
                    $('#searchResult').fadeOut(300, function() {
                        $(this).empty();
                    });
                }
            });
        });
    </script>
@endpush
