/**
 * @author Camilo Parra <parr0124@algonquinlive.com>
 * Student Number: 041117912
 */

const depositForm = document.querySelector('form');
const principalAmount = document.querySelector('#principalAmount');
const radioContactPhone = document.querySelector('#contactMethodPhone');
const radioContactEmail = document.querySelector('#contactMethodEmail');
const hourlyContactSection = document.querySelector('#hourlyContactSection');
const calcResultSection = document.querySelector('#calcResultSection');
const btnClear = document.querySelector('#btnClear');
const btnSubmit = document.querySelector('#btnSubmit');

/**
* 
* @return {HTMLElement}
*/
function createRadio(labelText) {
    const em = document.createElement('div');
    const chkTime = document.createElement('input');
    const label = document.createElement('label');
    
    em.classList.add('u-input-chk');
    chkTime.setAttribute('type', 'checkbox');
    chkTime.setAttribute('name', 'time[]');
    chkTime.setAttribute('value', labelText);
    label.textContent = labelText;

    em.append(chkTime);
    em.append(label);

    return em;
}

/**
* 
* @return {HTMLElement}
*/
function createRadioTimeGroup() {
    const times = [
        '9:00 am - 10:00 am',
        '10:00 am - 11:00 am',
        '11:00 am - 12:00 am',
        '12:00 am - 1:00 pm',
        '1:00 pm - 2:00 pm',
        '2:00 pm - 3:00 pm',
        '3:00 pm - 4:00 pm',
        '4:00 pm - 5:00 pm',
        '5:00 pm - 6:00 pm',
    ]

    const title = document.createElement('h3');
    title.textContent = "When can we contact you? Check all applicable:";

    const radioTimeGroup = document.createElement('div');
    radioTimeGroup.append(title);
    
    for (const time of times) {
        
        radioTimeGroup.append(createRadio(time));
    }

    renderFragment(radioTimeGroup);
}

/**
* @param times
* @return {void}
*/
function renderFragment(times) {
    hourlyContactSection.innerHTML = '';
    const frag = document.createDocumentFragment();
    
    frag.append(times);
    
    hourlyContactSection.append(frag);
}

/**
* @return {void}
*/
function clearFragment() {
    hourlyContactSection.innerHTML = '';
}

/**
* @return {void}
*/
function clearSections(e) {
    e.preventDefault();
    depositForm.principalAmount.value = '';
    depositForm.yearsToDeposit.value = '';
    depositForm.name.value = '';
    depositForm.postalCode.value = '';
    depositForm.phoneNumber.value = '';
    depositForm.emailAddress.value = '';
    radioContactPhone.checked = false;
    radioContactEmail.checked = false;
    hourlyContactSection.innerHTML = '';
    calcResultSection.innerHTML = '';
    principalAmount.focus();
}

// btnSubmit.addEventListener('click', (e) => {
//     //e.preventDefault();
//     const inpChecks = document.getElementsByName('time[]');
//     for (const inpChk of inpChecks) {
//         console.log(inpChk.checked);
//         if(inpChk.checked) inpChk.checked = true;
//     }
// });

btnClear.addEventListener('click', clearSections);

radioContactPhone.addEventListener('click', createRadioTimeGroup);
radioContactEmail.addEventListener('click', clearFragment);

