document.addEventListener('DOMContentLoaded', function () {
    var jobSeekerForm = document.getElementById('jobSeekerForm');
    var employerForm = document.getElementById('employerForm');
    var loginForm = document.getElementById('loginForm');


    function validateForm(event) {
        var inputs = event.target.elements;
        var valid = true;

        // Email validation regex pattern
        var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        // Loop through each input for validation
        for (var i = 0; i < inputs.length; i++) {
            var input = inputs[i];

            if (input.name === 'email' && !emailPattern.test(input.value)) {
                alert('Please enter a valid email address');
                valid = false;
                break;
            }


            if (/*input.required && */ input.value.trim() === '') {
                alert(input.name + ' should not be empty');
                valid = false;
                break;
            }

           
            
            if (input.type === 'tel' && (!/^\d{8}$/.test(input.value))) {
                alert('Please enter a valid phone number with exactly 8 digits.');
                valid = false;
                break;
            }
            
            // Validate date is not in the future
            if (input.type === 'date') {
                var today = new Date();
                var inputDate = new Date(input.value);
                today.setHours(0, 0, 0, 0);  // Clear time part
                if (inputDate > today) {
                    alert('Date of birth cannot be in the future');
                    valid = false;
                    break;
                }
            }
        }

        if (!valid) {
            event.preventDefault();  // Stop form submission if validation fails
        }
    }

   
    

    // Add event listener for form submission
    if (loginForm) {
        loginForm.addEventListener('submit', validateForm);
    }

    if (jobSeekerForm) {
        jobSeekerForm.addEventListener('submit', validateForm);
    }

    if (employerForm) {
        employerForm.addEventListener('submit', validateForm);
    }
});

