$(document).ready(function () {
  // for inserting data
  $("#submit-btn").click(function () {
    console.log($(this));
    let formData = new FormData();
    let name = $("#name").val();
    let grade = $("#grade").val();
    let dob = $("#dob").val();
    let hobbies = $("input:checkbox[name='hobbies[]']:checked") // How to deal with Array Values
      .map(function () {
        return $(this).val();
      })
      .get();
    let gender = $('input[name="gender"]:checked').val();
    let email = $("#email").val();
    let file = $('#picture')[0].files[0];
    console.log(name);
    console.log(grade);
    console.log(dob);
    console.log(gender);
    console.log(email);
    console.log(hobbies);
    formData.append("save", 1);
    formData.append("name", name);
    formData.append("grade", grade);
    formData.append("dob", dob);
    formData.append("gender", gender);
    formData.append("email", email);
    formData.append("picture", file);
    formData.append("hobbies[]", hobbies);
    //hobbies.forEach((hobby) => console.log(hobby));
    $.ajax({
      url: 'get_data.php',
      type: "POST",
      dataType: 'json',
      cache: false,
      contentType: false,
      processData: false,
      data: formData,
      success: function (response) {
        $("#name").val("");
        $("#grade").val("");
        $("#dob").val("");
        $("#gender").val(null);
        $("#email").val("");
        $("#hobbies").val(null);
        location.reload();
      },
    });
  });
  /* Edit Button */
  $(".edit-btn").click(function () {
    let id = $(this).data('id');
    $("#hiddenId").val(id);
    console.log(id);
    $.ajax({
      url: 'get_data.php',
      type: "POST",
      dataType: 'json',
      data: { fetch_row: 1, id: id, },
      success: function (data) {
        console.log(data);
        //document.getElementById('studentName').value = data.name;
        $("#studentName").val(data.name);
        $("#studentGrade").val(data.grade);
        $("#studentDob").val(data.dob);
        $("#studentEmail").val(data.email);
        //$(`input[name="gender"][value="${data.gender}"]`).prop("checked", true);
        $(`input[name="genderEdit"][value="${data.gender}"]`).prop("checked", true);
        // console.log(data.hobby);
        let hobbies = document.querySelectorAll('input[name="hobbiesEdit[]"]')  // It selects all inputs here with the same name
        // console.log(hobbies);
        $('input[name="hobbiesEdit[]"]').prop("checked", false);
        let hobby = data.hobby.split(",");       // converts it into an array from a string
        // alert();
        hobbies.forEach(checkbox => {                   // run a for loop on an item named
          // console.log('from db: '+hobby);
          // console.log('is exist: '+checkbox.value);
          if (Array.isArray(hobby)) {                               // If it's an array or not
            let isChecked = hobby.includes(checkbox.value);     // matches checkbox's buttons to the a hobby array,returns true or false in accordance
            // console.log(isChecked);
            if (isChecked == true) {                             // if the match is found
              checkbox.checked = isChecked;                     // correct it
            }
          }
        });
      }
    });
  });

  // To Update The Records
$("#real-update-btn").click(function () {
  Swal.fire({
    title: "Do you want to save the changes?",
    showDenyButton: true,
    showCancelButton: true,
    confirmButtonText: "Save",
    denyButtonText: `Don't save`
  }).then((result) => {
    if (result.isConfirmed) {
      let id = $("#hiddenId").val();
      let formData = new FormData();
      let name = $("#studentName").val();
      let grade = $("#studentGrade").val();
      let dob = $("#studentDob").val();
      let email = $("#studentEmail").val();
      let gender = $('input[name="genderEdit"]:checked').val();
      let hobbies = $("input:checkbox[name='hobbiesEdit[]']:checked")
        .map(function () {
          return $(this).val();
        }).get();
      let file = $('#studentPicture')[0].files[0];

      formData.append("update", 1);
      formData.append("id", id);
      formData.append("name", name);
      formData.append("grade", grade);
      formData.append("dob", dob);
      formData.append("gender", gender);
      formData.append("email", email);
      formData.append("picture", file);
      hobbies.forEach((hobby, index) => {
        formData.append("hobbies[]", hobby);
      });

      console.log(id);
      console.log(grade);
      console.log(dob);
      console.log(gender);
      console.log(email);
      console.log(file);

      $.ajax({
        url: 'get_data.php',
        type: "POST",
        data: formData,
        dataType: 'json',
        cache: false,
        contentType: false,
        processData: false,
        success: function (response) {
          // alert(response);
          // location.reload();
        }
      });

      Swal.fire("Saved!", "", "success");
    } else if (result.isDenied) {
      Swal.fire("Changes are not saved", "", "info");
    }
  });
});
$("#real-update-btn").click(function () {

    Swal.fire({
      title: "Are you sure?",
      text: "You won't be able to revert this!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, delete it!"
    }).then((result) => {
      if (result.isConfirmed) {
        let id = $(this).data('id');
        let formData = new FormData();
        formData.append("delete", 1);
        formData.append("id", id);
        console.log(formData);
        $.ajax({
          url: 'get_data.php',
          type: "POST",
          contentType: false,
          processData: false,
          dataType: 'json',
          data: formData,
          success: function (response) {
            alert(response);
            location.reload();
          }
        });
        Swal.fire({
          title: "Deleted!",
          text: "This record has been deleted",
          icon: "success"
        });
      }
    });

  });
});

