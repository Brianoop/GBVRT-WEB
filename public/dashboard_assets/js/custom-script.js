const deleteCaseButton = document.getElementById('deleteCaseBtn');

deleteCaseButton.addEventListener('click', function(event){
    event.preventDefault();

    if( confirm("Delete this case?" ) ) 
    {
        

        deleteUserCase(deleteCaseButton.value).then(data => {

            console.log(JSON.stringify(data));

            if(data.status == 200) return alert('Deleted successfully')

            if(data.status == 404) return alert('Failed!')

            return alert('An error occurred!');
            
        });
    } 
});

async function deleteUserCase(userId) {

    const response = await fetch('http://localhost/gbvrt/api/delete-user-case', {
        method: 'POST',
        mode: 'same-origin',
        cache: 'no-cache',
        credentials: 'same-origin',
        headers: {
        'Content-Type': 'application/json'
        },
        redirect: 'follow',
        referrerPolicy: 'no-referrer',
        body: JSON.stringify({id: userId})
    });
    console.log(response)
    return response;
}


