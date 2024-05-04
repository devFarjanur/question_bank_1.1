@extends('courseteacher.courseteacher_dashboard')
@section('courseteacher')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<div class="page-content">
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Question</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add Blooms Question</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Add BLOOMS Question</h4>

                    <form method="POST" action="#">

                        @csrf

                        <div class="">
                            <label for="question_description" class="form-label">Question Description:</label>
                            <textarea id="question_description" class="form-control" name="question_description[]" rows="4" cols="50" placeholder="Question Description"></textarea>
                        </div>

                    <div id="show_item">
                        <!-- Initial question inputs -->
                        <div class='row question'>
                            <div class="mt-5 mb-3">
                                <label class="form-label">Add Question A:</label>
                                <input class="form-control" name="question_text[]" type="text">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Bloom's Taxonomy Level:</label>
                                <select class="form-control" name="bloom_taxonomy[]">
                                    <option value="" selected disabled>-- Select Category --</option>
                                    <option value="Remembering">Remembering</option>
                                    <option value="Understanding">Understanding</option>
                                    <option value="Applying">Applying</option>
                                    <option value="Analyzing">Analyzing</option>
                                    <option value="Evaluating">Evaluating</option>
                                    <option value="Creating">Creating</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Add Question Mark:</label>
                                <input class="form-control" name="question_mark[]" type="text">
                            </div>
                        </div>
                    </div>

                    <!-- Add more button -->
                    <div class="col-md-3 mt-2 mb-5">
                        <button class="btn btn-primary mb-3 add_item_btn">Add More</button>
                    </div>

                    <!-- Add other form fields for options and correct answer if needed -->

                    <input class="btn btn-primary" type="submit" value="Submit">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        var questionCount = 0; // Initialize question count to 0

        $(".add_item_btn").click(function(e) {
            e.preventDefault();
            questionCount++;
            $("#show_item").append(`
                <div class='row question'>
                    <div class="mt-5 mb-3">
                        <label class="form-label">Add Question ${String.fromCharCode(65 + questionCount)}:</label> <!-- Use 65 (ASCII for 'A') -->
                        <input class="form-control" name="question_text[]" type="text">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Bloom's Taxonomy Level:</label>
                        <select class="form-control" name="bloom_taxonomy[]">
                            <option value="" selected disabled>-- Select Category --</option>
                            <option value="Remembering">Remembering</option>
                            <option value="Understanding">Understanding</option>
                            <option value="Applying">Applying</option>
                            <option value="Analyzing">Analyzing</option>
                            <option value="Evaluating">Evaluating</option>
                            <option value="Creating">Creating</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Add Question Mark:</label>
                        <input class="form-control" name="question_mark[]" type="text">
                    </div>

                    <div class="col-md-3 mt-2">
                        <button class="btn btn-danger mb-3 remove_item_btn">Remove</button>
                    </div>

                </div>
            `);
        });
    });
</script>

@endsection