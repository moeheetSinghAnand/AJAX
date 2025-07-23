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

  $("#edit-btn").click(function () {
    let id = $(this).data('id');
    console.log(id);
    $.ajax({
      url: 'get_data.php',
      type: 'POST',
      dataType: 'json',
      data: { fetch_row: 1, id: id,},
      success: function (data) {
        console.log(data);
        document.getElementById('studentName').value = data.name;
        // $("#studentName").val(data.name);
        $("#studentGrade").val(data.grade);
        $("#studentDob").val(data.dob);
        $("#studentEmail").val(data.email);
        $(`input[name="gender"][value="${data.gender}"]`).prop("checked", true);
        
        data.hobby.forEach(function (hobbies) {
          console.log(hobbies);
          // $(`input[name='hobbies[]'][value="${hobbies}"]`).prop("checked", true);
        });
      } 
      });
  });
});






























// var edit_id;
// var $edit_comment;

// // Edit button clicked - load comment into form
// $(document).on('click', '.edit', function() {
//   edit_id = $(this).data('id');
//   $edit_comment = $(this).parent();
//   var name = $(this).siblings('.display_name').text();
//   var comment = $(this).siblings('.comment_text').text();

//   $('#name').val(name);
//   $('#comment').val(comment);
//   $('#submit_btn').hide();
//   $('#update_btn').show();
// });

// // update button
//   $(document).on('click', '#update_btn', function() {
//     var id = edit_id;
//     var name = $('#name').val();
//     var comment = $('#comment').val();
//     $.ajax({
//       url: 'server.php',
//       type: 'POST',
//       data: {
//         'update': 1,
//         'id': id,
//         'name': name,
//         'comment': comment,
//       },
//       success: function(response) {
//         $('#name').val('');
//         $('#comment').val('');
//         $('#submit_btn').show();
//         $('#update_btn').hide();
//         $edit_comment.replaceWith(response); // Update comment in DOM
//       }
//     });
//   });
