<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Service Request</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    .tags-input {
    position: relative;
}

.predefined-tags {
    position: absolute;
    top: 100%;
    left: 0;
    width: 100%;
    background-color: #fff;
    border: 1px solid #ccc;
    padding: 0;
    margin: 0;
    list-style-type: none;
    display: none;
}

.predefined-tags li {
    padding: 5px 10px;
    cursor: pointer;
}

.predefined-tags li:hover {
    background-color: #f1f1f1;
}

.tag {
    display: inline-block;
    background-color: #f1f1f1;
    padding: 5px 10px;
    margin-right: 5px;
    border-radius: 3px;
}
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Create Service Request</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('service-requests.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="category" class="form-label">Category</label>
                                <input type="text" class="form-control" id="category" name="category" required>
                            </div>

                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control" id="title" name="title" required>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="location" class="form-label">Location</label>
                                <input type="text" class="form-control" id="location" name="location" required>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="start_date" class="form-label">Start Date</label>
                                    <input type="date" class="form-control" id="start_date" name="start_date"
                                        required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="end_date" class="form-label">End Date</label>
                                    <input type="date" class="form-control" id="end_date" name="end_date" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="start_time" class="form-label">Start Time</label>
                                    <input type="time" class="form-control" id="start_time" name="start_time"
                                        required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="end_time" class="form-label">End Time</label>
                                    <input type="time" class="form-control" id="end_time" name="end_time" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="skill_tags" class="form-label">Skill Tags</label>
                                <input type="text" class="form-control" id="skill_tags" name="skill_tags" required>
                            </div>
{{-- <div class="mb-3">
    <label for="skill_tags" class="form-label">Skill Tags</label>
    <div class="tags-input">
        <input type="text" class="form-control" id="skill_tags" name="skill_tags" required>
        <ul class="predefined-tags">
            <li class="tag">painting</li>
            <li class="tag">carpentry</li>
            <!-- Add more predefined tags here -->
        </ul>
    </div>
</div> --}}
                         
                            <div class="mb-3">
                                <label for="provider_gender" class="form-label">Preferred Provider Gender</label>
                                <select class="form-select" id="provider_gender" name="provider_gender">
                                    <option value="">No preference</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="job_type" class="form-label">Job Type</label>
                                <select class="form-select" id="job_type" name="job_type" required>
                                    <option value="project_based">Project Based</option>
                                    <option value="hourly_rate">Hourly Rate</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="hourly_rate" class="form-label">Hourly Rate</label>
                                <input type="number" step="0.01" class="form-control" id="hourly_rate"
                                    name="hourly_rate" value="0.00" required>
                            </div>
                            <div class="mb-3">
                                <label for="expected_price" class="form-label">Expected Price</label>
                                <input type="number" step="0.01" class="form-control" id="expected_price"
                                    name="expected_price" value="0.00" required>
                            </div>
                            <div class="mb-3">
                                <label for="estimated_duration" class="form-label">Estimated Duration (hours)</label>
                                <input type="number" class="form-control" id="estimated_duration"
                                    name="estimated_duration" value="0" required>
                            </div>
                            <div class="mb-3">
                                <label for="attach_media" class="form-label">Attach Media</label>
                                <input type="file" class="form-control" id="attach_media" name="attach_media"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="attach_media2" class="form-label">Attach Media 2</label>
                                <input type="file" class="form-control" id="attach_media2" name="attach_media2">
                            </div>
                            <div class="mb-3">
                                <label for="attach_media3" class="form-label">Attach Media 3</label>
                                <input type="file" class="form-control" id="attach_media3" name="attach_media3">
                            </div>
                            <div class="mb-3">
                                <label for="attach_media4" class="form-label">Attach Media 4</label>
                                <input type="file" class="form-control" id="attach_media4" name="attach_media4">
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-lg">Create Service Request</button>
                            </div>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    {{-- <script>
    document.addEventListener('DOMContentLoaded', function() {
    const skillTagsInput = document.getElementById('skill_tags');
    const predefinedTags = document.querySelectorAll('.predefined-tags li');
    const selectedTags = [];

    skillTagsInput.addEventListener('click', function() {
        document.querySelector('.predefined-tags').style.display = 'block';
    });

    predefinedTags.forEach(function(tag) {
        tag.addEventListener('click', function() {
            const tagText = this.textContent;
            if (!selectedTags.includes(tagText)) {
                selectedTags.push(tagText);
                addTag(tagText);
                skillTagsInput.value = selectedTags.join(', ');
                document.querySelector('.predefined-tags').style.display = 'none';
            }
        });
    });

    document.addEventListener('click', function(event) {
        if (!event.target.closest('.tags-input')) {
            document.querySelector('.predefined-tags').style.display = 'none';
        }
    });

    function addTag(tagText) {
        const tagElement = document.createElement('span');
        tagElement.classList.add('tag');
        tagElement.textContent = tagText;
        tagElement.addEventListener('click', function() {
            removeTag(tagText);
        });
        skillTagsInput.parentNode.insertBefore(tagElement, skillTagsInput);
    }

    function removeTag(tagText) {
        const index = selectedTags.indexOf(tagText);
        if (index !== -1) {
            selectedTags.splice(index, 1);
            skillTagsInput.value = selectedTags.join(', ');
            const tagElement = document.querySelector(`.tag:nth-child(${index + 1})`);
            tagElement.parentNode.removeChild(tagElement);
        }
    }
});
    </script> --}}
</body>

</html>
