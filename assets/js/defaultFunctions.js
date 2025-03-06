export function fetchData(body, url = '/assets/php/functions.php') {
    return fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(body)
    })
    .then(response => response.json())
    .catch(err => {
        console.error('Error fetching events data:', err);
        return null;
    });
}