<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h3 class="card-title text-center mb-4">🔗 URL Shortener</h3>

                    @if (session('success'))
                        <div class="alert alert-success">
                            Original URL: <a href="{{ session('original_url') }}"
                                target="_blank">{{ session('original_url') }}</a>
                        </div>
                        <div class="alert alert-success">
                            Short URL: <a href="{{ session('short_url') }}" id="shortUrl"
                                target="_blank">{{ session('short_url') }}</a>
                        </div>
                        <button class="btn btn-sm btn-outline-primary  " onclick="copyToClipboard()">
                            <i class="bi bi-clipboard"></i> Copy
                        </button>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <form action="{{ route('shorten') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="original_url" class="form-label">Enter your long URL</label>
                            <input type="url" name="original_url" class="form-control"
                                placeholder="https://example.com/long-url" required>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Shorten URL</button>
                        </div>
                    </form>

                    @if ($errors->any())
                        <div class="alert alert-danger mt-3">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                </div>
            </div>

        </div>
    </div>
</div>
<script>
    function copyToClipboard() {
        const shortUrl = document.getElementById('shortUrl').href;
        navigator.clipboard.writeText(shortUrl).then(function() {
            alert("Short URL copied to clipboard!");
        }, function(err) {
            alert("Failed to copy: " + err);
        });
    }
</script>
