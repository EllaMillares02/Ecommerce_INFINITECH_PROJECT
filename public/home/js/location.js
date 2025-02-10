async function fetchSuggestions() {
    const locationInput = document.getElementById('location');
    const suggestionsList = document.getElementById('suggestions-list');
    const query = locationInput.value;

    if (query.length < 3) {
        suggestionsList.style.display = 'none';
        return;
    }

    // Use the 'countrycodes' parameter to limit to the Philippines
    const url = `https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(query)}&addressdetails=1&limit=5&countrycodes=PH`;

    try {
        const response = await fetch(url);
        const results = await response.json();

        suggestionsList.innerHTML = '';
        suggestionsList.style.display = 'block';

        results.forEach(result => {
            // Check if the result is in Albay, Philippines
            if (result.address && result.address.state && result.address.state.includes('Albay')) {
                const suggestionItem = document.createElement('li');
                suggestionItem.textContent = result.display_name;
                suggestionItem.style.cursor = 'pointer';
                suggestionItem.style.padding = '5px';
                suggestionItem.addEventListener('click', () => {
                    locationInput.value = result.display_name;
                    suggestionsList.style.display = 'none';
                });
                suggestionsList.appendChild(suggestionItem);
            }
        });

        // Hide the list if no valid results are found
        if (!suggestionsList.hasChildNodes()) {
            suggestionsList.style.display = 'none';
        }

    } catch (error) {
        console.error('Error fetching location suggestions:', error);
    }
}
