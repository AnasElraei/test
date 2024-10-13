// Automatically show the quiz section after successful registration
window.addEventListener('load', function() {
    if (window.location.href.includes('#quiz-section')) {
        document.getElementById('quiz-section').style.display = 'block';
        document.getElementById('login-section').style.display = 'none';
    }
});