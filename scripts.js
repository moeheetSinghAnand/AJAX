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
    let hobbies=  $("input[name='hobbies[].checked']")
    .map(function () {               // How to deal with array values
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

    $.ajax({
      url: "get_data.php",
      type: "POST",
      data: {
        'save': 1,
        'name': name,
        'grade': grade,
        'dob': dob,
        'hobbies': hobbies,
        'gender': gender,
        'email': email
      },

      success: function (response) {
        $("#name").val("");
        $("#grade").val("");
        $("#dob").val("");
        $('#gender').val(null);
        $("#email").val("");
        $("#hobbies").val(null)
      },

    });
  });
});
