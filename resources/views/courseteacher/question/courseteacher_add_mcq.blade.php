@extends('courseteacher.courseteacher_dashboard')
@section('courseteacher')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<div class="page-content">
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Question</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add Question</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Add Question</h4>

                    <form method="POST" action="{{ route('courseadmin.mcq.question.store', $id) }}" enctype="multipart/form-data">
                        @csrf 

                        <div id="show_item">
                            <!-- Initial question inputs -->
                            <div class="row question">
                                <div class="mb-3">
                                    <label for="question" class="form-label">Question Text:</label>
                                    <input id="question" class="form-control" name="question[]" type="text">
                                </div>
                                <div class="mb-3">
                                    <label for="optionA" class="form-label">Option a</label>
                                    <input id="optionA" class="form-control" name="optionA[]" type="text">
                                </div>
                                <div class="mb-3">
                                    <label for="optionB" class="form-label">Option b</label>
                                    <input id="optionB" class="form-control" name="optionB[]" type="text">
                                </div>
                                <div class="mb-3">
                                    <label for="optionC" class="form-label">Option c</label>
                                    <input id="optionC" class="form-control" name="optionC[]" type="text">
                                </div>
                                <div class="mb-3">
                                    <label for="optionD" class="form-label">Option d</label>
                                    <input id="optionD" class="form-control" name="optionD[]" type="text">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Correct Option:</label>
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" name="correct_option[0]" value="a">
                                        <label class="form-check-label" for="correctOptionA">Option a</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" name="correct_option[0]" value="b">
                                        <label class="form-check-label" for="correctOptionB">Option b</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" name="correct_option[0]" value="c">
                                        <label class="form-check-label" for="correctOptionC">Option c</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" name="correct_option[0]" value="d">
                                        <label class="form-check-label" for="correctOptionD">Option d</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Add more button -->
                        <div class="col-md-3 mt-2 mb-5">
                            <button class="btn btn-primary mb-3 add_item_btn">Add More</button>
                        </div>

                        <input class="btn btn-primary" type="submit" value="Submit">
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $(".add_item_btn").click(function(e) {
            e.preventDefault();
            var index = $('.question').length;
            $("#show_item").append(`
                <div class="row question">
                    <div class="mb-3 mt-5">
                        <label for="question" class="form-label">Question Text:</label>
                        <input id="question" class="form-control" name="question[]" type="text">
                    </div>
                    <div class="mb-3">
                        <label for="optionA" class="form-label">Option a</label>
                        <input id="optionA" class="form-control" name="optionA[]" type="text">
                    </div>
                    <div class="mb-3">
                        <label for="optionB" class="form-label">Option b</label>
                        <input id="optionB" class="form-control" name="optionB[]" type="text">
                    </div>
                    <div class="mb-3">
                        <label for="optionC" class="form-label">Option c</label>
                        <input id="optionC" class="form-control" name="optionC[]" type="text">
                    </div>
                    <div class="mb-3">
                        <label for="optionD" class="form-label">Option d</label>
                        <input id="optionD" class="form-control" name="optionD[]" type="text">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Correct Option:</label>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" name="correct_option[${index}]" value="a">
                            <label class="form-check-label" for="correctOptionA">Option a</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" name="correct_option[${index}]" value="b">
                            <label class="form-check-label" for="correctOptionB">Option b</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" name="correct_option[${index}]" value="c">
                            <label class="form-check-label" for="correctOptionC">Option c</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" name="correct_option[${index}]" value="d">
                            <label class="form-check-label" for="correctOptionD">Option d</label>
                        </div>
                    </div>
                    <div class="col-md-3 mt-2">
                        <button class="btn btn-danger mb-3 remove_item_btn">Remove</button>
                    </div>
                </div>
            `);
        });

        $(document).on('click','.remove_item_btn', function(e) {
            e.preventDefault();
            $(this).closest('.question').remove();
        });
    });
</script>

@endsection