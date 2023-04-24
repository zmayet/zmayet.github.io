
// //This function is called in login.php
// // When the user clicks on div the popup whose id=myPopup will be displayed
// function myFunction() {
//     var popup = document.getElementById("myPopup");
//     popup.classList.toggle("show");
//   }



// //Function in quiz.php
  
// //Below is the array containing the questions and their respective four options and one correct answer
// const quizData = [
//     {
//         question: "Which Japanese film studio began in 1985?",
//         a: "Madhouse",
//         b: "Wizz",
//         c: "Mappa",
//         d: "Studio Ghibli",
//         correct: "d",
//     },
//     {
//         question: "Who sang 'Gurenge' from Demon Slayer?",
//         a: "MISA",
//         b: "LISA",
//         c: "MIMI",
//         d: "LUCY",
//         correct: "b",
//     },
//     {
//         question: "I'll take a ______ and eat it ?",
//         a: "Potato Chip",
//         b: "Carrot Stick",
//         c: "Mushroom",
//         d: "Pineapple",
//         correct: "a",
//     },
//     {
//         question: "What is Naruto's favourite dish?",
//         a: "Meat",
//         b: "Ramen",
//         c: "Rice",
//         d: "Curry",
//         correct: "b",
//     },
// ];
// //getting the values of all divs,labels and input boxes by using getElement method 
// const quiz= document.getElementById('quiz')
// const answerEls = document.querySelectorAll('.answer')
// const questionEl = document.getElementById('question')
// const a_text = document.getElementById('a_text')
// const b_text = document.getElementById('b_text')
// const c_text = document.getElementById('c_text')
// const d_text = document.getElementById('d_text')
// const submitBtn = document.getElementById('submit')
// let currentQuiz = 0
// let score = 0
// //loading the quiz that we have stored in above array
// loadQuiz()
// function loadQuiz() {
//     // Deselect any previously selected answers
//     deselectAnswers();

//     // Load the current quiz question and answers and setting all the label's values/innerhtml
//     const currentQuizData = quizData[currentQuiz];
//     //setting label's text
//     questionEl.innerText = currentQuizData.question;
//     a_text.innerText = currentQuizData.a;
//     b_text.innerText = currentQuizData.b;
//     c_text.innerText = currentQuizData.c;
//     d_text.innerText = currentQuizData.d;
// }

// function deselectAnswers() {
//     // Deselect all answer choices by unchecking their radio buttons
//     answerEls.forEach(answerEl => answerEl.checked = false);
// }

// function getSelected() {
//     let answer;

//     // Loop through all answer choices and find the selected one
//     answerEls.forEach(answerEl => {
//         if(answerEl.checked) {
//             answer = answerEl.id;
//         }
//     });

//     // Return variable of selected answer choice
//     return answer;
// }

// // Add an event listener to the submit button
// submitBtn.addEventListener('click', () => {
//     const answer = getSelected();

//     // If an answer is selected, check if it is correct
//     //if answer is correct then increment the score
//     if(answer) {
//        if(answer === quizData[currentQuiz].correct) {
//            score++;
//        }

//        // Move on to the next question
//        currentQuiz++;

//        // If there are more questions, load the next one
//        if(currentQuiz < quizData.length) {
//            loadQuiz();
//        } else {
//            // If all questions have been answered, show the final score and a reload button
//            quiz.innerHTML = `
//            <h2>You answered ${score}/${quizData.length} questions correctly</h2>
//            <button class="button" type="reload" onclick="location.reload()">Reload</button>
//            `;
//        }
//     }
// });

// // Functions in rate.php

// // Get all star elements
// const stars = document.querySelectorAll('.star');

// // Add click event listener to each star
// stars.forEach((star) => {
//   star.addEventListener('click', () => {
//     // Remove active class from all stars
//     stars.forEach((s) => {
//       s.classList.remove('active');
//     });
//     // Add active class to the star that was clicked and all earlier stars
//     star.classList.add('active');
//     let prev = star.previousElementSibling;
//     while (prev) {
//       prev.classList.add('active');
//       prev = prev.previousElementSibling;
//     }
//         // Set the hidden input value to the chosen rating.
//         const ratingInput = document.getElementById('rating-input');
//     ratingInput.value = star.dataset.rating;
//   });
// });
// //Create the submitReview function, which will be invoked when the user submits the review form.
// function submitReview() {
//       // Get the rating input field element
//       const ratingInput = document.getElementById('rating-input');
//       // Obtain the rating input field's value.
//       const rating = ratingInput.value;

//       // Get the form element
//       const form = document.querySelector('form');
//       // Submit the form
//       form.submit();
// }

// // Set the initial slide index to 1
// let slideIndex = 1;
// // Show the first slide
// showSlides(slideIndex);

// // Create the plusSlides function, which accepts the input n (1 or -1).
// function plusSlides(n) {
// // Use the current slide index + n when calling the showSlides method.
// showSlides(slideIndex += n);
// }

// // Create the currentSlide function, which accepts the input n (the slide number).
// function currentSlide(n) {
//     // With the current slide index set to n, call the showSlides method.
//     showSlides(slideIndex = n);
// }

// // Create the function showSlides, which accepts the input n (the slide number).
// function showSlides(n) {
//       let i;
//       // Get all slide elements
//       let slides = document.getElementsByClassName("mySlides");
//       // Get all dot elements
//       let dots = document.getElementsByClassName("dot");

//       //Slide index should be set to 1 if it exceeds the number of slides.
//       if (n > slides.length) {slideIndex = 1}

//       // If the slide index is less than 1, set the slide index to the last slide
//       if (n < 1) {slideIndex = slides.length}

//       // Loop through all slide elements and hide them
//       for (i = 0; i < slides.length; i++) {
//       slides[i].style.display = "none";
//       }
//       // Loop through all dot elements and replace the "active" class with ""/no class
//       for (i = 0; i < dots.length; i++) {
//       dots[i].className = dots[i].className.replace(" active", "");
//       }
//       // Display the current slide and add the "active" class to the corresponding dot element
//       slides[slideIndex-1].style.display = "block";
//       dots[slideIndex-1].className += " active";
// }

// //Function in shop.php

// //function to show the thank you message
// function tyMessage() {
//     alert("Thank you buying this item ^_^,");
//   }
 