<style>
    .material-symbols-rounded {
        font-variation-settings:
            'FILL' 1,
            'wght' 400,
            'GRAD' 0,
            'opsz' 24;
    }
    
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    
    body {
        background-color: #dadde6;
        font-family: arial, sans-serif;
    }
    
    .container {
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    
    .row {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 20px;
        width: 100%;
        max-width: 1500px;
    }
    
    .card {
        display: block;
        width: 600px;
        background-color: #fff;
        color: #989898;
        font-family: 'Oswald', sans-serif;
        text-transform: uppercase;
        border-radius: 4px;
        position: relative;
        margin: 0; /* Eliminado el margen izquierdo */
    }
    
    .date {
        display: table-cell;
        width: 25%;
        text-align: center;
        border-right: 2px dashed #dadde6;
        position: relative;
    }
    
    .date:before,
    .date:after {
        content: "";
        display: block;
        width: 30px;
        height: 30px;
        background-color: #dadde6;
        position: absolute;
        top: -15px;
        right: -15px;
        z-index: 1;
        border-radius: 50%;
    }
    
    .date:after {
        bottom: -15px;
        top: auto;
    }
    
    .date time {
        display: block;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
    
    .date time span:first-child {
        color: #2b2b2b;
        font-weight: 600;
        font-size: 250%;
    }
    
    .date time span:last-child {
        text-transform: uppercase;
        font-weight: 600;
        margin-top: -10px;
    }
    
    .card-cont {
        display: table-cell;
        width: 75%;
        font-size: 85%;
        padding: 10px 10px 30px 50px;
    }
    
    .card-cont h3 {
        color: #3c3c3c;
        font-size: 130%;
    }
    
    .card-cont .even-date i,
    .card-cont .even-info i,
    .card-cont .even-date time,
    .card-cont .even-info p {
        display: table-cell;
    }
    
    .card-cont .even-info p {
        padding: 30px 50px 0 0;
    }
    
    .card-cont a {
        display: block;
        text-decoration: none;
        width: 80px;
        height: 30px;
        background-color: #d8dde0;
        color: #fff;
        text-align: center;
        line-height: 30px;
        border-radius: 2px;
        position: absolute;
        right: 10px;
        bottom: 10px;
    }
    
    .row:last-child .card:first-child .card-cont a {
        background-color: #037fdd;
    }
    
    .row:last-child .card:last-child .card-cont a {
        background-color: #f8504c;
    }
    
    @media screen and (max-width: 860px) {
        .card {
            width: 100%;
            margin-bottom: 10px;
        }
    
        .card-cont .even-date,
        .card-cont .even-info {
            font-size: 75%;
        }
    }
</style>