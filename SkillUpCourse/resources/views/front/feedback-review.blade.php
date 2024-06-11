@extends('layouts.frontend.main')

@section('title', 'Course Feedback')

@section('content')
    <div class="container mt-5">
        <h2 class="text-center mb-4">Course Feedback</h2>
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('admin.reviews.store', $course->id) }}">
                    @csrf
                    <div class="form-group mb-4">
                        <label for="rating" class="form-label fw-bold">Rating</label>
                        <div class="rating">
                            <input type="hidden" name="rating" id="rating">
                            <label for="star5" title="5 stars" class="star" data-value="5">&#9733;</label>
                            <input type="radio" name="star" id="star5" value="5">
                            <label for="star4" title="4 stars" class="star" data-value="4">&#9733;</label>
                            <input type="radio" name="star" id="star4" value="4">
                            <label for="star3" title="3 stars" class="star" data-value="3">&#9733;</label>
                            <input type="radio" name="star" id="star3" value="3">
                            <label for="star2" title="2 stars" class="star" data-value="2">&#9733;</label>
                            <input type="radio" name="star" id="star2" value="2">
                            <label for="star1" title="1 star" class="star" data-value="1">&#9733;</label>
                            <input type="radio" name="star" id="star1" value="1">
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <label for="note" class="form-label fw-bold">Review Note</label>
                        <textarea name="note" class="form-control" id="note" rows="4" placeholder="Write your feedback here..."></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit Review</button>
                </form>
            </div>
        </div>
    </div>

    <style>
        .rating {
            display: flex;
            flex-direction: row-reverse;
            justify-content: center;
        }

        .rating input {
            display: none;
        }

        .rating label {
            cursor: pointer;
            color: #ccc;
            font-size: 40px;
            transition: color 0.2s;
        }

        .rating label:hover,
        .rating label:hover~label {
            color: #FFD700;
        }

        .rating input:checked~label {
            color: #FFD700;
        }

        .rating:hover input:checked~label {
            color: #ccc;
        }

        .rating input:checked~label:hover,
        .rating input:checked~label:hover~label {
            color: #FFD700;
        }
    </style>

    <script>
        const stars = document.querySelectorAll('.star');
        const ratingInput = document.getElementById('rating');

        stars.forEach(star => {
            star.addEventListener('click', () => {
                const value = parseInt(star.getAttribute('data-value'));
                ratingInput.value = value;
                stars.forEach(s => {
                    const sValue = parseInt(s.getAttribute('data-value'));
                    if (sValue <= value) {
                        s.style.color = '#FFD700';
                    } else {
                        s.style.color = '#ccc';
                    }
                });
            });
        });
    </script>
@endsection
