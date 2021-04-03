

const inputs = document.querySelectorAll("input");
const reg ={

    email: /^([a-z\d\.-])+@([a-z\d-])+\.([a-z]{2,4})(\.[a-z]{2,4})?$/i,
    ingredients:/^[a-zA-Z]+(,[a-zA-Z]+)?(,[a-zA-Z]+)?$/i,
    title: /^([a-z ]{2,20})$/
};


function matchh(field,regex)
{
    if(regex.test(field.value))
    {
        field.classList.add("true");
        field.classList.remove("false");
    }

    else  {
        field.classList.add("false");
        field.classList.remove("true");
    }
}



inputs.forEach((input)=>{
    input.addEventListener('keyup',(e)=>{
        matchh(e.target,reg[e.target.name]);
    });
});