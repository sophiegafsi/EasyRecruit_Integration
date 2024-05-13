// Postform_validation.js

document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById("contact-form");
    const titleInput = document.getElementById("title");
    const contentInput = document.getElementById("content");
    const upVotesInput = document.getElementById("upVotes");

    function validateForm() {
        let isValid = true;
        document.querySelectorAll(".error-message").forEach(function(error) {
            error.textContent = "";
        });

        if (titleInput.value.trim() === "") {
            document.getElementById("titleError").textContent = "Please enter a title";
            isValid = false;
        }

        const contentValue = contentInput.value.trim();
        if (contentValue === "") {
            document.getElementById("contentError").textContent = "Please enter content";
            isValid = false;
        } else if (contentValue.length < 20 || contentValue.length > 200) {
            document.getElementById("contentError").textContent = "Content must be between 20 and 200 characters long";
            isValid = false;
        }

        if (upVotesInput.value.trim() === "" || isNaN(upVotesInput.value.trim())) {
            document.getElementById("upvoteError").textContent = "Please enter a valid number for up votes";
            isValid = false;
        }

        return isValid;
    }

    form.addEventListener("submit", function(event) {
        if (!validateForm()) {
            event.preventDefault();
        }
    });
});
