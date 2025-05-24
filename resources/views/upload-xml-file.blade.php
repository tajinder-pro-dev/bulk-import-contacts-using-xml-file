<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Import Contacts from XML</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Bootstrap Icons CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
    
    <style>
        body {
            background: linear-gradient(135deg, #74ebd5 0%, #ACB6E5 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }
        .card {
            border-radius: 1rem;
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
        }
        .card-header {
            border-top-left-radius: 1rem;
            border-top-right-radius: 1rem;
        }
        .form-label i {
            color: #0d6efd;
            margin-right: 6px;
        }
        .helper-text {
            font-size: 0.875rem;
            color: #6c757d;
        }
    </style>
</head>
<body>

<div class="card shadow-lg p-4" style="width: 100%; max-width: 450px;">
    <div class="card-header bg-primary text-white text-center py-3 mb-4">
        <h3 class="mb-0">
            <i class="bi bi-file-earmark-arrow-up-fill"></i> Import Contacts
        </h3>
        <small>Upload an XML file to bulk import your contacts</small>
    </div>

    {{-- Success Message --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- File Upload Form --}}
    <form action="{{ route('contacts.importfile.xml') }}" method="POST" enctype="multipart/form-data" novalidate>
        @csrf

        <div class="mb-4">
            <label for="xml_file" class="form-label">
                <i class="bi bi-filetype-xml"></i> Select XML File
            </label>
            <input type="file" name="xml_file" id="xml_file" class="form-control form-control-lg @error('xml_file') is-invalid @enderror" accept=".xml,text/xml" 
                aria-describedby="fileHelp" required />
            @error('xml_file')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary btn-lg w-100 shadow-sm">
            <i class="bi bi-upload me-2"></i> Import Contacts
        </button>
    </form>
</div>

<!-- Bootstrap JS bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
