
// const handleRequest = (url, request_type, data, )=> {
//   $.ajax({
//     url: "../actions/get_chores.php",
//     type: "POST",
//     data: JSON.stringify({
//       request: "get_chore",
//       cid: cid,
//     }),
//     dataType: "json",
//     contentType: "application/json",
//     success: function (data, status) {
      
//       let results = data.data
//       $("#update_chore_name").val(results.chorename);

//     },
//     error: function (textStatus, errorMessage) {
//       console.log("Error: " + errorMessage + "TextStatus: " + textStatus);

//       Swal.fire({
//         icon: "error",
//         title: "Something went wrong",
//         text: "Try Again!",
//       }).then(function () {
//         setTimeout(function () {
//           window.location.reload();
//         }, 500);
//       });
//     },
//   });
// }


// export default handleRequest;