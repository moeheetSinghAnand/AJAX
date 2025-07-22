<?php include "dbconfig.php"; ?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Student CRUD Form using AJAX</title>
  <link rel="stylesheet" href="style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
   <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.css" rel="stylesheet" />
</head>

<body>
  <!--
  <div class="container mt-5">
    <section>
      <div class="row mb-4">
        <div class="col-12">
          <div class="bg-dark p-3 text-white">
            <h1 class="text-center">AJAX</h1>
          </div>
        </div>
      </div>
    </section>       -->


  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-sm-6">
        <h1 class="text-center text-white bg-dark">AJAX</h1>

        <form method="post">
          <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" id="name" class="form-control form-control-sm" required>
          </div>

          <div class="mb-3">
            <label for="grade" class="form-label">Grade</label>
            <input type="text" name="grade" id="grade" class="form-control form-control-sm" required>
          </div>

          <div class="mb-3">
            <label class="form-label d-block">Gender </label>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="gender" id="Male" value="Male">
              <label class="form-check-label" for="Male">Male </label>
            </div>

            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="gender" id="Female" value="Female">
              <label class="form-check-label" for="Female">Female</label>
            </div>
          </div>

          <div class="mb-3">
            <label for="dob" class="form-label">Date of Birth</label>
            <input type="date" name="dob" id="dob" class="form-control form-control-sm" required>
          </div>

          <div>
            <label for="email" class="form-label">Email</label>
            <input class="form-control form-control-sm mb-3" type="text" id="email" name="email">
          </div>

          <div class="mb-3">
            <label class="form-label">Hobbies</label>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="hobbies[]" value="Reading" id="Reading">
              <label class="form-check-label" for="Reading">Reading</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="hobbies[]" value="Sports" id="Sports">
              <label class="form-check-label" for="Sports">Sports</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="hobbies[]" value="Music" id="Music">
              <label class="form-check-label" for="Music">Music</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="hobbies[]" value="Anime" id="Anime">
              <label class="form-check-label" for="Anime">Anime</label>
            </div>
          </div>

          <input class="form-control mb-3" type="file" placeholder="Name" id="picture" name="picture">

          <div class="mb-3 text-center">
            <button type="button" id="submit-btn" name="submit-btn" class="btn btn-primary">Submit</button>
        
          </div>
        </form>


        <div class="table-responsive">
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Name</th>
                <th>Grade</th>
                <th>Gender</th>
                <th>DOB</th>
                <th>Email</th>
                <th>Hobbies</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
			         <?php
                    $select = "SELECT * FROM students";
                    $new_result = mysqli_query($conn, $select);
                    $index = 0;
                    if (mysqli_num_rows($new_result) > 0) {
                        while ($row = mysqli_fetch_assoc($new_result)) {
                            ++$index;
              ?>
                    <tr>
                        <td><?php  echo $index; ?></td> 
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['grade']; ?></td>
                        <td><?php echo $row['gender']; ?></td>
						            <td><?php echo date('d-m-Y', strtotime($row['dob'])); ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['hobby']; ?></td>
                        <td>
                            <button class="btn btn-outline-info btn-sm me-2" data-bs-toggle="modal"
                                    data-bs-target="#edit-btn">
                                <i class="ri-eye-line"></i>
                            </button>							
                        </td>
                    </tr>
                <?php
                        }
                    }
                ?>
			</tbody>

            <!--  EDIT BUTTON -->
            <div class="modal" id="edit-btn" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">

                  <div class="modal-header">
                    <h5 class="modal-title">Edit Student</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                  </div>

                  <div class="modal-body">
                    <form>
                      <div class="mb-3">
                        <label>Name</label>
                        <input class="form-control form-control-sm" type="text" placeholder="" id="studentName">
                      </div>
                      <div class="mb-3">
                        <label>Grade</label>
                        <input class="form-control form-control-sm" type="text" placeholder="" id="studentRoll">
                      </div>

                      <div class="mb-3">
                        <label class="form-label d-block">Gender </label>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="gender" id="Male" value="Male">
                          <label class="form-check-label" for="Male">Male </label>
                        </div>

                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="gender" id="Female" value="Female">
                          <label class="form-check-label" for="Female">Female</label>
                        </div>
                      </div>

                      <div class="mb-3">
                        <labeL>DOB</labeL>
                        <input class="form-control form-control-sm" type="date" placeholder="" id="studentGrade">
                      </div>

                      <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input class="form-control form-control-sm" type="text" id="email" name="email">
                      </div>
					  
                      <div class="mb-3">
                        <label class="form-label">Hobbies</label>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" name="hobbies[]" value="Reading" id="Reading">
                          <label class="form-check-label" for="Reading">Reading</label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" name="hobbies[]" value="Sports" id="Sports">
                          <label class="form-check-label" for="Sports">Sports</label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" name="hobbies[]" value="Music" id="Music">
                          <label class="form-check-label" for="Music">Music</label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" name="hobbies[]" value="Anime" id="Anime">
                          <label class="form-check-label" for="Anime">Anime</label>
                        </div>
                      </div>

                    </form>
                  </div>

                  <div class="modal-footer">
                    <button class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-success" type="button" onclick="editButton()">Submit</button>
                  </div>

                </div>
              </div>
            </div>
      </div>
    </div>
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="scripts.js" type="text/JavaScript"></script>
</body>

</html>

    <!--<button type="button" id="update-btn" name="update-btn" class="btn btn-primary" data-bs-toggle="modal"
              data-bs-target="#edit-btn">Edit</button> -->