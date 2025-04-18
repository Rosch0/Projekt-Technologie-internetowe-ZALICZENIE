document.addEventListener('DOMContentLoaded', function() {
    // Pobieranie elementów DOM
    const searchInput = document.getElementById('pattern-search');
    const searchError = document.getElementById('search-error');
    const bullishBtn = document.getElementById('bullish-btn');
    const bearishBtn = document.getElementById('bearish-btn');
    const allBtn = document.getElementById('all-btn');
    const patternsContainer = document.getElementById('patterns-container');
    const patternCards = document.querySelectorAll('.pattern-card');
    const descriptionPreviews = document.querySelectorAll('.pattern-description-preview');
    
    // Inicjalizacja danych formacji
    const patterns = Array.from(patternCards).map(card => ({
        element: card,
        name: card.querySelector('.pattern-name').textContent.toLowerCase(),
        type: card.classList.contains('bullish') ? 'bullish' : 'bearish'
    }));
    
    // Funkcja wyszukiwania
    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase().trim();
        
        // Czyszczenie poprzedniego błędu
        searchError.style.display = 'none';
        
        // Jeśli pole wyszukiwania jest puste, pokaż wszystkie formacje zgodnie z aktywnym filtrem
        if (searchTerm === '') {
            updateDisplay();
            return;
        }
        
        // Filtrowanie formacji wg wyszukiwanej frazy
        const filteredPatterns = patterns.filter(pattern => 
            pattern.name.includes(searchTerm)
        );
        
        // Wyświetlenie błędu, jeśli nie znaleziono formacji
        if (filteredPatterns.length === 0) {
            searchError.textContent = 'Nie znaleziono formacji o podanej nazwie';
            searchError.style.display = 'block';
        }
        
        // Aktualizacja wyświetlania na podstawie wyników wyszukiwania
        patterns.forEach(pattern => {
            if (filteredPatterns.includes(pattern)) {
                pattern.element.style.display = 'block';
            } else {
                pattern.element.style.display = 'none';
            }
        });
    });
    
    // Funkcja aktualizacji wyświetlania na podstawie filtrów
    function updateDisplay() {
        const searchTerm = searchInput.value.toLowerCase().trim();
        const activeFilter = document.querySelector('.filter-btn.active').id;
        
        patterns.forEach(pattern => {
            // Zastosowanie filtra typu (bullish/bearish/all)
            let showPattern = true;
            
            if (activeFilter === 'bullish-btn' && pattern.type !== 'bullish') {
                showPattern = false;
            } else if (activeFilter === 'bearish-btn' && pattern.type !== 'bearish') {
                showPattern = false;
            }
            
            // Zastosowanie filtra wyszukiwania, jeśli jest fraza
            if (searchTerm && !pattern.name.includes(searchTerm)) {
                showPattern = false;
            }
            
            // Aktualizacja wyświetlania
            pattern.element.style.display = showPattern ? 'block' : 'none';
        });
        
        // Wyświetlenie błędu, jeśli nie ma widocznych formacji po filtrowaniu
        const visiblePatterns = patterns.filter(p => 
            p.element.style.display !== 'none'
        );
        
        if (visiblePatterns.length === 0) {
            searchError.textContent = 'Brak formacji spełniających kryteria';
            searchError.style.display = 'block';
        } else {
            searchError.style.display = 'none';
        }
    }
    
    // Obsługa przycisków filtrowania
    [bullishBtn, bearishBtn, allBtn].forEach(btn => {
        btn.addEventListener('click', function() {
            // Aktualizacja aktywnego przycisku
            document.querySelector('.filter-btn.active').classList.remove('active');
            this.classList.add('active');
            
            // Aktualizacja wyświetlania
            updateDisplay();
        });
    });
    
    // Rozwijanie/zwijanie opisów formacji
    descriptionPreviews.forEach(preview => {
        preview.addEventListener('click', function() {
            const card = this.closest('.pattern-card');
            const fullDesc = card.querySelector('.pattern-description-full');
            
            if (fullDesc.style.display === 'block') {
                fullDesc.style.display = 'none';
            } else {
                // Najpierw ukryj wszystkie inne opisy
                document.querySelectorAll('.pattern-description-full').forEach(desc => {
                    desc.style.display = 'none';
                });
                
                fullDesc.style.display = 'block';
            }
        });
    });
});
