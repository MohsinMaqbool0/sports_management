<!DOCTYPE html>
<html lang="en">

<head>

  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>OTP Verification</title>

  <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="assets/vendors/jvectormap/jquery-jvectormap.css">
  <link rel="stylesheet" href="assets/vendors/flag-icon-css/css/flag-icon.min.css">
  <link rel="stylesheet" href="assets/vendors/owl-carousel-2/owl.carousel.min.css">
  <link rel="stylesheet" href="assets/vendors/owl-carousel-2/owl.theme.default.min.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="shortcut icon" href="assets/images/favicon.png" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
    integrity="sha384-Z1JAd13uiNpqUf5IepilhAtMuHQJ4q/9pa1Px59+C+HDUWYbmOSlEXc2xlM+3HxK" crossorigin="anonymous">

  <style>
    /* Import Google font - Poppins */
    @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap");


    :where(.cont, form, .input-field, header) {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
    }

    .cont {
      background: #fff;
      padding: 30px 65px;
      margin: 10px 300px;
      border-radius: 12px;
      row-gap: 20px;
      width: 35%;
      box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
    }

    .cont header {
      height: 65px;
      width: 65px;
      background: #000;
      color: #fff;
      font-size: 2.5rem;
      border-radius: 50%;
      text-align: center;
    }

    .cont h4 {
      font-size: 1.25rem;
      color: #333;
      font-weight: 500;
    }

    form .input-field {
      flex-direction: row;
      column-gap: 10px;
    }

    .input-field input {
      height: 45px;
      width: 42px;
      border-radius: 6px;
      outline: none;
      font-size: 1.125rem;
      text-align: center;
      border: 1px solid #ddd;
    }

    .input-field input:focus {
      box-shadow: 0 1px 0 rgba(0, 0, 0, 0.1);
    }

    .input-field input::-webkit-inner-spin-button,
    .input-field input::-webkit-outer-spin-button {
      display: none;
    }

    form button {
      margin-top: 25px;
      width: 100%;
      color: #fff;
      font-size: 1rem;
      border: none;
      padding: 9px 0;
      cursor: pointer;
      border-radius: 6px;
      pointer-events: none;
      background: #6e93f7;
      transition: all 0.2s ease;
    }

    form button.active {
      background: #4070f4;
      pointer-events: auto;
    }

    form button:hover {
      background: #0e4bf1;
    }
  </style>

</head>

<body>

  <div class="container-scroller">

<?php
// Get the value of the 'id' parameter
    $userId = $_GET['id'];

?>

    <!-- Main Section Start -->
    <div class="container-fluid page-body-wrapper">
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="col-lg-12 ">
            <div class="card">
              <div class="card-body">
                <div class="cont">
                  <header>
                    <img src="assets/images/verified.png">
                  </header>
                  <h4>Enter OTP Code</h4>
                  <?php

                  session_start();
                  if (isset($_SESSION['error'])) {
                    echo '<p class="warning-message alert alert-danger m-4">' . $_SESSION['error'] . '</p>';
                    // Clear the error message from the session
                    unset($_SESSION['error']);
                  }
                  ?>
                  <form action="./database-files/check-otp.php" method="post">
                    <div class="input-field">
                      <input type="number" name="OTP_1" />
                      <input type="number" disabled name="OTP_2" />
                      <input type="number" disabled name="OTP_3" />
                      <input type="number" disabled name="OTP_4" />
                      <input type="number" disabled name="OTP_5" />
                      <input type="number" disabled name="OTP_6" />

                    </div>
                        <input type="hidden" name="id" value="<?php echo $userId ?>">
                    <!-- <button>Verify OTP</button> -->
                    <button name="btn" type="submit" class="btn btn-primary me-2"
                      style="padding: 1rem 2rem; font-size: 1rem; border: none;">Verify OTP</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Main Section End -->
      </div>

      <Script>
        const inputs = document.querySelectorAll("input"),
          button = document.querySelector("button");

        // iterate over all inputs
        inputs.forEach((input, index1) => {
          input.addEventListener("keyup", (e) => {
            // This code gets the current input element and stores it in the currentInput variable
            // This code gets the next sibling element of the current input element and stores it in the nextInput variable
            // This code gets the previous sibling element of the current input element and stores it in the prevInput variable
            const currentInput = input,
              nextInput = input.nextElementSibling,
              prevInput = input.previousElementSibling;

            // if the value has more than one character then clear it
            if (currentInput.value.length > 1) {
              currentInput.value = "";
              return;
            }
            // if the next input is disabled and the current value is not empty
            //  enable the next input and focus on it
            if (nextInput && nextInput.hasAttribute("disabled") && currentInput.value !== "") {
              nextInput.removeAttribute("disabled");
              nextInput.focus();
            }

            // if the backspace key is pressed
            if (e.key === "Backspace") {
              // iterate over all inputs again
              inputs.forEach((input, index2) => {
                // if the index1 of the current input is less than or equal to the index2 of the input in the outer loop
                // and the previous element exists, set the disabled attribute on the input and focus on the previous element
                if (index1 <= index2 && prevInput) {
                  input.setAttribute("disabled", true);
                  input.value = "";
                  prevInput.focus();
                }
              });
            }
            //if the fourth input( which index number is 3) is not empty and has not disable attribute then
            //add active class if not then remove the active class.
            if (!inputs[5].disabled && inputs[5].value !== "") {
              button.classList.add("active");
              return;
            }
            button.classList.remove("active");
          });
        });

        //focus the first input which index is 0 on window load
        window.addEventListener("load", () => inputs[0].focus());

      </script>

</body>

</html>
