$(document).ready(function () {
  // for inserting data
  $("#submit-btn").click(function () {
    console.log($(this));
    // alert('check');
    // js document.getElementById('name').value
    // js document.getElementByClassName('name').value
    // js document.getElementsByName('name').value
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

    console.log(name);
    console.log(grade);
    console.log(dob);
    console.log(gender);
    console.log(email);
    console.log(hobbies);
    //hobbies.forEach((hobby) => console.log(hobby));
    $.ajax({
      url: "get_data.php",
      type: "POST",
      data: {
        save: 1,
        name: name,
        grade: grade,
        dob: dob,
        gender: gender,
        // email: email,
        hobbies: hobbies,
      },

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

  $(".edit-btn").click(function () {
    let id = $(this).data('id');
    console.log(id);
    $.ajax({
      url: 'get_data.php',
      type: 'POST',
      dataType: 'json',
      data: { fetch_row: 1, id: id, },
      success: function (data) {
        console.log(data);
        document.getElementById('studentName').value = data.name;
        // $("#studentName").val(data.name);
        $("#studentGrade").val(data.grade);
        $("#studentDob").val(data.dob);
        $("#studentEmail").val(data.email);
        $(`input[name="gender"][value="${data.gender}"]`).prop("checked", true);
        // console.log(data.hobby);
        let hobbies = document.querySelectorAll('input[name="hobbiesEdit[]"]')  // It selects all inputs here with the same name
        // console.log(hobbies);
        $('input[name="hobbiesEdit[]"]').prop("checked", false);
        let hobby = data.hobby.split(",");       // converts it into an array from a string
        
        // alert();
        hobbies.forEach(checkbox => {                   // run a for loop on an item named
          // console.log('from db: '+hobby);
          // console.log('is exist: '+checkbox.value);
          if(Array.isArray(hobby)){                               // If it's an array or not
              let isChecked = hobby.includes(checkbox.value);     // matches checkbox's buttons to the ahobby array,returns true or false in accordance
              // console.log(isChecked);
              if (isChecked == true){                             // if the match is found
                checkbox.checked = isChecked;                     // correct it
              }
          }
          });
      }
    });

  });
});










