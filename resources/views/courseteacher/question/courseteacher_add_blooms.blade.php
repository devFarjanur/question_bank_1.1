@extends('courseteacher.courseteacher_dashboard')

@section('courseteacher')



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

                        <form method="POST" action="{{ route('course.teacher.blooms.store', $id) }}">
                            @csrf

                            <div class="question">
                                <label for="question_description" class="form-label">Question Description:</label>
                                <textarea id="question_description" class="form-control" name="question_description" rows="4" cols="50" placeholder="Question Description"></textarea>
                            </div>

                            <div id="show_item">
                                <!-- Initial question inputs -->
                                <div class="row question">
                                    <div class="col-md-4 mt-5">
                                        <label class="form-label">Add Question A:</label>
                                        <input class="form-control" name="question_text[]" type="text">
                                    </div>
                                    <div class="col-md-4 mt-5">
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
                                    <div class="col-md-2 mt-5">
                                        <label class="form-label">Add Question Mark:</label>
                                        <input class="form-control" name="question_mark[]" type="text">
                                    </div>
                                    <div class="col-md-2 mt-6 text-center">
                                        <!-- Add more button -->
                                        <button class="btn btn-primary mb-3 add_item_btn">Add More</button>
                                    </div>
                                </div>
                            </div>

                            <!-- Add other form fields for options and correct answer if needed -->

                            <input class="btn btn-primary mt-3" type="submit" value="Submit">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            // Function to handle removal of question
            $(document).on("click", ".remove_item_btn", function(e) {
                e.preventDefault();
                $(this).closest(".question").remove();
            });

            // Function to handle addition of question
            $(".add_item_btn").click(function(e) {
                e.preventDefault();
                var questionCount = $(".question").length + 1;
                $("#show_item").append(
                    `<div class='row question'>
                        <div class="col-md-4 mt-5">
                            <label class="form-label">Add Question ${String.fromCharCode(65 + questionCount)}:</label>
                            <input class="form-control" name="question_text[]" type="text">
                        </div>
                        <div class="col-md-4 mt-5">
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
                        <div class="col-md-2 mt-5">
                            <label class="form-label">Add Question Mark:</label>
                            <input class="form-control" name="question_mark[]" type="text">
                        </div>
                        <div class="col-md-2 mt-6 text-center">
                            <button class="btn btn-danger mb-3 remove_item_btn">Remove</button>
                        </div>
                    </div>`
                );
            });
        });
    </script>
@endsection
