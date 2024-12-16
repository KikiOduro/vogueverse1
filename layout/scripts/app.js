$(document).ready(function () {
  /**
   * Chores Management Section
   */
  // * Close all modals
  $(".close").on("click", () => {
    $(".modal").hide();
  });

  // * Handle the add chore modal click
  $("#submit_chore").on("click", () => {
    const chore_name = $("#chore_name").val();
    if (chore_name == "") {
      alert("Please enter a chore name");
    } else {
      $(".modal").hide();
      $.ajax({
        url: "../actions/add_chores.php",
        type: "POST",
        data: JSON.stringify({
          request: "add_chore",
          chore_name: chore_name,
        }),
        dataType: "json",
        contentType: "application/json",
        success: function (data, status) {
          console.log(data.status, status);

          if (data.status == "success" && status == "success") {
            Swal.fire({
              icon: "success",
              title: "New Chore Added",
              text: "Chore added successfully!",
            }).then(function () {
              setTimeout(function () {
                window.location.reload();
              }, 500);
            });
          }
        },
        error: function (textStatus, errorMessage) {
          console.log("Error: " + errorMessage + "TextStatus: " + textStatus);

          Swal.fire({
            icon: "error",
            title: "Something went wrong",
            text: "Try Again!",
          }).then(function () {
            setTimeout(function () {
              window.location.reload();
            }, 500);
          });
        },
      });
    }
  });

  // * Handle the edit chore modal click
  $(".edit_chore").on("click", function () {
    // console.log($(this).data("cid"));
    const cid = $(this).data("cid");
    $("#edit_modal").show();

    $.ajax({
      url: "../actions/get_chores.php",
      type: "POST",
      data: JSON.stringify({
        request: "get_chore",
        cid: cid,
      }),
      dataType: "json",
      contentType: "application/json",
      success: function (data, status) {
        let results = data.data;
        $("#update_chore_name").val(results.chorename);
        $("#update_cid").val(results.cid);
      },
      error: function (textStatus, errorMessage) {
        console.log("Error: " + errorMessage + "TextStatus: " + textStatus);
        Swal.fire({
          icon: "error",
          title: "Something went wrong",
          text: "Try Again!",
        }).then(function () {
          setTimeout(function () {
            window.location.reload();
          }, 500);
        });
      },
    });
  });

  // * Handle the update chore modal click
  $("#updated_chore_btn").on("click", function () {
    $("#edit_modal").hide();

    $.ajax({
      url: "../actions/update_chores.php",
      type: "POST",
      data: JSON.stringify({
        request: "update_chore",
        chore_name: $("#update_chore_name").val(),
        cid: $("#update_cid").val(),
      }),
      dataType: "json",
      contentType: "application/json",
      success: function (data, status) {
        if (data.status == "success" && status == "success") {
          Swal.fire({
            icon: "success",
            title: "Chore Updated",
            text: "Chore updated successfully!",
          }).then(function () {
            setTimeout(function () {
              window.location.reload();
            }, 500);
          });
        }
      },
      error: function (textStatus, errorMessage) {
        console.log("Error: " + errorMessage + "TextStatus: " + textStatus);
        Swal.fire({
          icon: "error",
          title: "Something went wrong",
          text: "Try Again!",
        }).then(function () {
          setTimeout(function () {
            window.location.reload();
          }, 500);
        });
      },
    });
  });

  // * Delete a chore
  $(".del_chore").on("click", function () {
    const cid = $(this).data("cid");

    Swal.fire({
      icon: "warning",
      title: "Are you sure?",
      text: "You won't be able to revert this!",
      showCancelButton: true,
      confirmButtonColor: "#093B7E",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, delete it!",
      cancelButtonText: "No, cancel!",
    }).then((result) => {
      if (result.isConfirmed) {
        deleteChore(cid);
      } else if (result.isDenied) {
        // Swal.fire("Changes are not saved", "", "info");
      }
    });
  });

  /**
   * Assignment Management Section
   */

  // * Edit Assignment 
  $(".edit-assignment-modal").on('click', function(){
    $(".edit-modal").show()
  })

  /***
   *  All Functions
   */
  function deleteChore(cid) {
    $.ajax({
      url: "../actions/delete_chores.php",
      type: "POST",
      data: JSON.stringify({
        request: "delete_chore",
        cid: cid,
      }),
      dataType: "json",
      contentType: "application/json",
      success: function (data, status) {
        if (data.status == "success" && status == "success") {
          Swal.fire({
            icon: "success",
            title: "Chore Deleted",
            text: "Chore deleted successfully!",
          }).then(function () {
            setTimeout(function () {
              window.location.reload();
            }, 500);
          });
        }
      },
      error: function (textStatus, errorMessage) {
        console.log("Error: " + errorMessage + "TextStatus: " + textStatus);
        Swal.fire({
          icon: "error",
          title: "Something went wrong",
          text: "Try Again!",
        }).then(function () {
          setTimeout(function () {
            window.location.reload();
          }, 500);
        });
      },
    });
  }
});
