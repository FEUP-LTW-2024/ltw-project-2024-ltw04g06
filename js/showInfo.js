function hideUserInfo(imgElement) {
    const userInfo = imgElement.nextElementSibling.querySelector('.user-info');
    const crown = imgElement.nextElementSibling.querySelector('.crown');
    userInfo.classList.remove('visible');
    crown.classList.remove('visible'); // Remove the 'visible' class from the crown
}

function showUserInfo(imgElement) {
    const userInfo = imgElement.nextElementSibling.querySelector('.user-info');
    const crown = imgElement.nextElementSibling.querySelector('.crown');
    userInfo.classList.add('visible');
    crown.classList.add('visible'); // Add the 'visible' class to the crown
}