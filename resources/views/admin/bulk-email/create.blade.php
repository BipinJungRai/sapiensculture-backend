@extends('layout.main')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Send Bulk Email</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('category2.index') }}">Bulk Emails</a></li>
                            <li class="breadcrumb-item active">Send Bulk Email</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <div class="container-fluid mt-6">
            <!-- Table -->
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('send.bulk.email') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="recipient-emails">Recipient Emails:</label>
                                    <input type="text" name="recipient-emails" class="form-control"
                                        placeholder="No any subscriber yet." id="recipient-emails"
                                        value="{{ implode(',', $activeSubscribers) }}">
                                </div>
                                <div class="form-group">
                                    <label for="email-subject">Email Subject:</label>
                                    <input type="text" name="email-subject" class="form-control"
                                        placeholder="Enter email subject">
                                </div>
                                <div class="form-group">
                                    <label for="email-body">Email Body:</label>
                                    <textarea name="email-body" id="emailBody" class="form-control" rows="5"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Send Email</button>
                            </form>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: 'textarea#emailBody', // Replace this CSS selector to match the placeholder element for TinyMCE
            plugins: 'powerpaste advcode table lists checklist',
            toolbar: 'undo redo | blocks| bold italic | bullist numlist checklist | code | table'
        });
    </script>
@endsection
