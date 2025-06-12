document.addEventListener("DOMContentLoaded", function () {
  const chatMessages = document.getElementById("chat-messages");
  const messageInput = document.getElementById("text");
  const messageForm = document.getElementById("messageArea");
  const typingIndicator = document.getElementById("typing-indicator");

  function getCurrentTime() {
    const now = new Date();
    return `${String(now.getHours()).padStart(
      2,
      "0"
    )}:${String(now.getMinutes()).padStart(2, "0")}`;
  }

  function scrollToBottom() {
    chatMessages.scrollTop = chatMessages.scrollHeight;
  }

  function addMessage(content, isUser) {
    const time = getCurrentTime();
    const wrapper = document.createElement("div");
    wrapper.className = `flex mb-4 ${
      isUser ? "justify-end" : "justify-start"
    } items-end`;

    if (isUser) {
      wrapper.innerHTML = `
        <div class="bg-blue-500 text-white rounded-xl px-4 py-2 max-w-[75%] relative">
          <p>${content}</p>
          <span class="text-xs text-gray-200 absolute bottom-1 right-2">${time}</span>
        </div>
        <img src="https://i.ibb.co/d5b84Xw/Untitled-design.png" class="w-8 h-8 rounded-full ml-3"/>
      `;
    } else {
      wrapper.innerHTML = `
        <img src="https://i.ibb.co/fSNP7Rz/icons8-chatgpt-512.png" class="w-8 h-8 rounded-full mr-3"/>
        <div class="bg-gray-200 text-gray-900 rounded-xl px-4 py-2 max-w-[75%] relative">
          <p>${content}</p>
          <span class="text-xs text-gray-500 absolute bottom-1 left-2">${time}</span>
        </div>
      `;
    }

    chatMessages.appendChild(wrapper);
    scrollToBottom();
  }

  messageForm.addEventListener("submit", function (e) {
    e.preventDefault();
    const rawText = messageInput.value.trim();
    if (!rawText) return;

    addMessage(rawText, true);
    messageInput.value = "";

    typingIndicator.classList.remove("hidden");
    scrollToBottom();

    $.ajax({
      data: { msg: rawText },
      type: "POST",
      url: "https://0c0661fc-706e-490d-ae19-dfd997fa4ce3-00-1v2rfla2fmswi.kirk.replit.dev/get",
    }).done(function (data) {
      typingIndicator.classList.add("hidden");

      addMessage(data, false);
    });
  });

  messageInput.addEventListener("keypress", function (e) {
    if (e.key === "Enter" && !e.shiftKey) {
      e.preventDefault();
      messageForm.dispatchEvent(new Event("submit"));
    }
  });
});
