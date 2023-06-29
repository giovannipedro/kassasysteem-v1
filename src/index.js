$(document).ready(function () {
  // Chatbot-log
  var chatLog = $("#chat-log");

  // Welkomstbericht
  var welcomeMessage =
    "Welkom bij ons restaurant! Hoe kan ik je van dienst zijn?";
  chatLog.append('<div class="bot-message">' + welcomeMessage + "</div>");

  // Functie om de chatcontainer te tonen
  function showChatContainer() {
    $("#chat-container").fadeIn();
  }

  // Functie om suggesties te genereren op basis van de gebruikersinvoer
  function generateSuggestions() {
    // Voeg hier je eigen logica toe om suggesties te genereren op basis van de gebruikersinvoer
    var suggestions =
      "Hier zijn een paar suggesties voor je: 1. Hamburger de luxe 1, 2. Stokbrood met kruidenboter 2, 3. Noorse zalm 3.";
    return suggestions;
  }

  // Functie om informatie over allergenen te genereren op basis van de gerechten
  function generateAllergenInfo() {
    // Voeg hier je eigen logica toe om informatie over allergenen te genereren op basis van de gerechten
    var allergenInfo =
      "All onze producten zijn plantaardig en dus gluten en alergenen vrij";
    return allergenInfo;
  }

  // Gebruikersinvoer verwerken en chatlog bijwerken
  function processUserInput() {
    var userInput = $("#user-input").val().trim();
    var userMessage = '<div class="user-message">' + userInput + "</div>";
    chatLog.append(userMessage);

    // Reactie van de chatbot genereren op basis van de gebruikersinvoer
    var botResponse;

    // Checken op keywords en aanroepen van juiste functie
    switch (true) {
      case userInput.includes("suggesties"):
        botResponse = generateSuggestions();
        break;
      case userInput.includes("allergenen"):
        botResponse = generateAllergenInfo();
        break;
      case userInput.includes("hallo"):
        botResponse = "Hallo, waar kan ik je mee helpen?";
        break;
      case userInput.includes("Coca Cola prijs"):
        botResponse = "Coca cola kost bij ons $2";
        break;
      default:
        botResponse = "Sorry, ik kan je niet helpen met dat verzoek.";
        break;
    }

    var botMessage = '<div class="bot-message">' + botResponse + "</div>";
    chatLog.append(botMessage);

    // Scrollen naar de onderkant van de chatlog
    chatLog.scrollTop(chatLog[0].scrollHeight);
    // Het invoerveld leegmaken
    $("#user-input").val("");
  }

  // Het invoerveld reageert op Enter-toets
  $("#user-input").keypress(function (event) {
    if (event.which === 13) {
      event.preventDefault();
      processUserInput();
    }
  });
  // Klikgebeurtenis voor de chatknop
  $("#chat-button").click(function () {
    var container = $("#chat-container");
    if (container.is(":hidden")) {
      showChatContainer();
      $("#chat-button").text("Sluit de chatbot");
      $("#chat-button").addClass("clicked");
    } else {
      container.hide();
      $("#chat-button").text("Chat met me");
      $("#chat-button").removeClass("clicked");
    }
  });

  $(".container-fluid").click(function () {
    window.location.href = "./scanner.php";
  });

  // Generate the link that would be
  // used to generate the QR Code
  // with the given data
  let finalURL =
    "https://chart.googleapis.com/chart?cht=qr&chl=" +
    window.location.href.replace("localhost", "145.107.253.209") +
    "&chs=160x160&chld=L|0";

  console.log(finalURL);

  // Replace the src of the image with
  // the QR code image
  $(".qr-code").attr("src", finalURL);

  $("#btn-popup").click(function () {
    $(".popup-overlay").toggle();
    $(".popup-overlay").css({
      display: "flex",
      "align-items": "center",
      "justify-content": "center"
    });
  });
  $("#close-popup").click(function () {
    $(".popup-overlay").hide();
  });
});
