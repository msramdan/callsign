@extends('layouts.app')

@section('title', __(key: 'Detail of Events'))

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-8 order-md-1 order-last">
                    <h3>{{ __(key: 'Events') }}</h3>
                    <p class="text-subtitle text-muted">
                        {{ __(key: 'Detail of event.') }}
                    </p>
                </div>
                <x-breadcrumb>
                    <li class="breadcrumb-item">
                        <a href="/">{{ __(key: 'Dashboard') }}</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route(name: 'events.index') }}">{{ __(key: 'Events') }}</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        {{ __(key: 'Detail') }}
                    </li>
                </x-breadcrumb>
            </div>
        </div>
        <section class="section">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-striped">
                                    <tr>
                                        <td class="fw-bold">{{ __(key: 'Nama Event') }}</td>
                                        <td>{{ $event->nama_event }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">{{ __(key: 'Tanggal Mulai') }}</td>
                                        <td>{{ isset($event->tanggal_mulai) ? $event->tanggal_mulai?->format('Y-m-d H:i:s') : '' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">{{ __(key: 'Tanggal Selesai') }}</td>
                                        <td>{{ isset($event->tanggal_selesai) ? $event->tanggal_selesai?->format('Y-m-d H:i:s') : '' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">{{ __(key: 'Template Sertifikat') }}</td>
                                        <td>
                                            <img src="{{ $event->template_sertifikat }}" alt="Template Sertifikat"
                                                class="rounded img-fluid"
                                                style="object-fit: cover; width: 350px; height: 200px;" />
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="fw-bold">{{ __(key: 'Nama Ncs') }}</td>
                                        <td>{{ $event->nama_ncs }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">{{ __(key: 'Callsign Ncs') }}</td>
                                        <td>{{ $event->callsign_ncs }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">{{ __(key: 'Poster') }}</td>
                                        <td>
                                            <img src="{{ $event->poster }}" alt="Poster" class="rounded img-fluid"
                                                style="object-fit: cover; width: 350px; height: 200px;" />
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <a href="{{ route(name: 'events.index') }}"
                                class="btn btn-secondary">{{ __(key: 'Back') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
