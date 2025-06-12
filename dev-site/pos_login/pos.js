document.addEventListener('DOMContentLoaded', function() {
    const recipeCards = document.querySelectorAll('.recipe-card');
            
recipeCards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-5px)';
                    this.style.boxShadow = '0 10px 20px rgba(0,0,0,0.1)';
                });
                
                card.addEventListener('mouseleave', function() {
                    this.style.transform = '';
                    this.style.boxShadow = '';
                });
            });

const chatbotBtn = document.querySelector('.floating-btn');
    chatbotBtn.addEventListener('click', function() {
        alert('Chatbot de Consumo Consciente\n\nComo posso te ajudar hoje?');
            });

const ingredientsBtns = document.querySelectorAll('.view-ingredients-btn');           
            ingredientsBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    const ingredientsList = this.nextElementSibling;
                    const icon = this.querySelector('i');
                    
                    ingredientsList.classList.toggle('show');
                    
                    if (ingredientsList.classList.contains('show')) {
                        this.innerHTML = 'Ocultar Ingredientes <i class="fas fa-chevron-up ml-1"></i>';
                        this.classList.add('bg-green-100');
                    } else {
                        this.innerHTML = 'Ver Ingredientes <i class="fas fa-chevron-down ml-1"></i>';
                        this.classList.remove('bg-green-100');
                    }
        });
    });
});