
window.onload = function() // pour que le script se lance que quand la page finit de charger
{
    if(document.getElementById("2")) // si l'id 2 existe il rentre dans la condition
    {
        var id2 = document.getElementById("2").style.width; // il va prendre la valeur de la largeur qui est dans l'id 2
        var competence2 = id2.replace("%", ""); // il remplace ici le % par une valeur nulle
        console.log(competence2);
    }
    if(document.getElementById("11")) // si l'id 11 existe il rentre dans la condition
    {
        var id11 = document.getElementById("11").style.width; // il va prendre la valeur de la largeur qui est dans l'id 11
        var competence11 = id11.replace("%", ""); // il remplace ici le % par une valeur nulle
        console.log(competence11);
    }
    if(document.getElementById("15")) // si l'id 15 existe il rentre dans la condition
    {
        var id15 = document.getElementById("15").style.width; // il va prendre la valeur de la largeur qui est dans l'id 15
        var competence15 = id15.replace("%", ""); // il remplace ici le % par une valeur nulle
        console.log(competence15);
    }
    if(document.getElementById("16")) // si l'id 16 existe il rentre dans la condition
    {
        var id16 = document.getElementById("16").style.width; // il va prendre la valeur de la largeur qui est dans l'id 16
        var competence16 = id16.replace("%", ""); // il remplace ici le % par une valeur nulle
        console.log(competence16);
    }
    if(document.getElementById("17")) // si l'id 17 existe il rentre dans la condition
    {
        var id17 = document.getElementById("17").style.width; // il va prendre la valeur de la largeur qui est dans l'id 17
        var competence17 = id17.replace("%", ""); // il remplace ici le % par une valeur nulle
        console.log(competence17);
    }
    if(document.getElementById("18")) // si l'id 18 existe il rentre dans la condition
    {
        var id18 = document.getElementById("18").style.width; // il va prendre la valeur de la largeur qui est dans l'id 18
        var competence18 = id18.replace("%", ""); // il remplace ici le % par une valeur nulle
        console.log(competence18);
    }
    if(document.getElementById("19")) // si l'id 19 existe il rentre dans la condition
    {
        var id19 = document.getElementById("19").style.width; // il va prendre la valeur de la largeur qui est dans l'id 19
        var competence19 = id19.replace("%", ""); // il remplace ici le % par une valeur nulle
        console.log(competence19);
    }
    if(document.getElementById("20")) // si l'id 20 existe il rentre dans la condition
    {
        var id20 = document.getElementById("20").style.width; // il va prendre la valeur de la largeur qui est dans l'id 20
        var competence20 = id20.replace("%", ""); // il remplace ici le % par une valeur nulle
        console.log(competence20);
    }
    if(document.getElementById("21")) // si l'id 21 existe il rentre dans la condition
    {
        var id21 = document.getElementById("21").style.width; // il va prendre la valeur de la largeur qui est dans l'id 21
        var competence21 = id21.replace("%", ""); // il remplace ici le % par une valeur nulle
        console.log(competence21);
    }
    if(document.getElementById("22")) // si l'id 22 existe il rentre dans la condition
    {
        var id22 = document.getElementById("22").style.width; // il va prendre la valeur de la largeur qui est dans l'id 22
        var competence22 = id22.replace("%", ""); // il remplace ici le % par une valeur nulle
        console.log(competence22);
    }
    if(document.getElementById("23")) // si l'id 23 existe il rentre dans la condition
    {
        var id23 = document.getElementById("23").style.width; // il va prendre la valeur de la largeur qui est dans l'id 23
        var competence23 = id23.replace("%", ""); // il remplace ici le % par une valeur nulle
        console.log(competence23);
    }
    if(document.getElementById("24")) // si l'id 24 existe il rentre dans la condition
    {
        var id24 = document.getElementById("24").style.width; // il va prendre la valeur de la largeur qui est dans l'id 24
        var competence24 = id24.replace("%", ""); // il remplace ici le % par une valeur nulle
        console.log(competence24);
    }
    if(document.getElementById("26")) // si l'id 26 existe il rentre dans la condition
    {
        var id26 = document.getElementById("26").style.width; // il va prendre la valeur de la largeur qui est dans l'id 26
        var competence26 = id26.replace("%", ""); // il remplace ici le % par une valeur nulle
        console.log(competence26);
    }
    if(document.getElementById("27")) // si l'id 27 existe il rentre dans la condition
    {
        var id27 = document.getElementById("27").style.width; // il va prendre la valeur de la largeur qui est dans l'id 27
        var competence27 = id27.replace("%", ""); // il remplace ici le % par une valeur nulle
        console.log(competence27);
    }
    if(document.getElementById("28")) // si l'id 28 existe il rentre dans la condition
    {
        var id28 = document.getElementById("28").style.width; // il va prendre la valeur de la largeur qui est dans l'id 28
        var competence28 = id28.replace("%", ""); // il remplace ici le % par une valeur nulle
        console.log(competence28);
    }
    if(document.getElementById("30")) // si l'id 30 existe il rentre dans la condition
    {
        var id30 = document.getElementById("30").style.width; // il va prendre la valeur de la largeur qui est dans l'id 30
        var competence30 = id30.replace("%", ""); // il remplace ici le % par une valeur nulle
        console.log(competence30);
    }
    
    var index = 0; // on initialise l'index à 0 pour qu'il parte de 0
    var boucleGlobale = setInterval(globale, 100); // la fonction globale va être lancée toutes les 0.25 secondes

    function globale() // on a la fonction globale
    {
        index++; // on incrémente l'index de 1
        console.log(index); 
        if(competence2 && competence2 >= index) // si il y a une competence et qu'elle est supérieur ou égale à l'index
        {
            document.getElementById("2").style.width = index + "%"; // on lui dit que la largeur de l'élément 2 doit être égale à la valeur de l'index
        }
        if(competence11 && competence11 >= index) // si il y a une competence et qu'elle est supérieur ou égale à l'index
        {
            document.getElementById("11").style.width = index + "%"; // on lui dit que la largeur de l'élément 2 doit être égale à la valeur de l'index
        }
        if(competence15 && competence15 >= index) // si il y a une competence et qu'elle est supérieur ou égale à l'index
        {
            document.getElementById("15").style.width = index + "%"; // on lui dit que la largeur de l'élément 2 doit être égale à la valeur de l'index
        }
        if(competence16 && competence16 >= index) // si il y a une competence et qu'elle est supérieur ou égale à l'index
        {
            document.getElementById("16").style.width = index + "%"; // on lui dit que la largeur de l'élément 2 doit être égale à la valeur de l'index
        }
        if(competence17 && competence17 >= index) // si il y a une competence et qu'elle est supérieur ou égale à l'index
        {
            document.getElementById("17").style.width = index + "%"; // on lui dit que la largeur de l'élément 2 doit être égale à la valeur de l'index
        }
        if(competence18 && competence18 >= index) // si il y a une competence et qu'elle est supérieur ou égale à l'index
        {
            document.getElementById("18").style.width = index + "%"; // on lui dit que la largeur de l'élément 2 doit être égale à la valeur de l'index
        }
        if(competence19 && competence19 >= index) // si il y a une competence et qu'elle est supérieur ou égale à l'index
        {
            document.getElementById("19").style.width = index + "%"; // on lui dit que la largeur de l'élément 2 doit être égale à la valeur de l'index
        }
        if(competence20 && competence20 >= index) // si il y a une competence et qu'elle est supérieur ou égale à l'index
        {
            document.getElementById("20").style.width = index + "%"; // on lui dit que la largeur de l'élément 2 doit être égale à la valeur de l'index
        }
        if(competence21 && competence21 >= index) // si il y a une competence et qu'elle est supérieur ou égale à l'index
        {
            document.getElementById("21").style.width = index + "%"; // on lui dit que la largeur de l'élément 2 doit être égale à la valeur de l'index
        }
        if(competence22 && competence22 >= index) // si il y a une competence et qu'elle est supérieur ou égale à l'index
        {
            document.getElementById("22").style.width = index + "%"; // on lui dit que la largeur de l'élément 2 doit être égale à la valeur de l'index
        }
        if(competence23 && competence23 >= index) // si il y a une competence et qu'elle est supérieur ou égale à l'index
        {
            document.getElementById("23").style.width = index + "%"; // on lui dit que la largeur de l'élément 2 doit être égale à la valeur de l'index
        }
        if(competence24 && competence24 >= index) // si il y a une competence et qu'elle est supérieur ou égale à l'index
        {
            document.getElementById("24").style.width = index + "%"; // on lui dit que la largeur de l'élément 2 doit être égale à la valeur de l'index
        }
        if(competence26 && competence26 >= index) // si il y a une competence et qu'elle est supérieur ou égale à l'index
        {
            document.getElementById("26").style.width = index + "%"; // on lui dit que la largeur de l'élément 2 doit être égale à la valeur de l'index
        }
        if(competence27 && competence27 >= index) // si il y a une competence et qu'elle est supérieur ou égale à l'index
        {
            document.getElementById("27").style.width = index + "%"; // on lui dit que la largeur de l'élément 2 doit être égale à la valeur de l'index
        }
        if(competence28 && competence28 >= index) // si il y a une competence et qu'elle est supérieur ou égale à l'index
        {
            document.getElementById("28").style.width = index + "%"; // on lui dit que la largeur de l'élément 2 doit être égale à la valeur de l'index
        }
        if(competence30 && competence30 >= index) // si il y a une competence et qu'elle est supérieur ou égale à l'index
        {
            document.getElementById("30").style.width = index + "%"; // on lui dit que la largeur de l'élément 2 doit être égale à la valeur de l'index
        }

        if(index==100) // si la valeur de l'index est égale à 100%
        {
            clearInterval(boucleGlobale);// on stoppe la boucle
        }
    }
}