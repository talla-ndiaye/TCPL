// Modifier la fonction generateNumbers dans tirage.js

function generateNumbers() {
  var lotteryNumbersDiv = document.getElementById('lottery-numbers');
  lotteryNumbersDiv.innerHTML = '';

  var resultString = "Résultat du tirage : ";
  for (var i = 0; i < 5; i++) {
    setTimeout(function() {
      var randomNumber = Math.floor(Math.random() * 50) + 1;
      var ball = document.createElement('div');
      ball.classList.add('ball');
      ball.textContent = randomNumber;
      ball.style.opacity = '0'; // Définir l'opacité initiale à 0
      lotteryNumbersDiv.appendChild(ball);

      setTimeout(function() {
        ball.style.opacity = '1'; // Appliquer une transition pour augmenter l'opacité à 1
      }, 50); // Ajouter un léger délai avant d'appliquer la transition

      // Concaténer les résultats dans une chaîne
      resultString += randomNumber + "-";

      lotteryNumbersDiv.scrollTop = lotteryNumbersDiv.scrollHeight;
    }, i * 1000); // Multiplier par i pour augmenter le délai entre chaque boule
  }
}


