
<style>
        .group {
            display: flex;
            line-height: 28px;
            align-items: center;
            position: relative;
            max-width: 190px;
            margin: 20px;
           
        }

        .input-placeholder { 
            width:500px;
            height: 40px;
            line-height: 28px;
            padding: 0 1rem;
            padding-left: 2rem;
            border: 2px solid transparent;
            border-radius: 8px;
            outline: none;
            background-color: #f3f3f4;
            color: #0d0c22;
            transition: .3s ease;
            font-size: 20px;
            font-family: 'Tajawal', sans-serif;

        }

        .input-placeholder::placeholder {
            padding-left: 20px;
            color: #9e9ea7;
            font-size: 15px;
            font-family: 'Tajawal', sans-serif;

        }

        .input-placeholder:focus,
        .input-placeholder:hover {
            outline: none;
            border-color: rgba(234, 76, 137, 0.4);
            background-color: #fff;
            box-shadow: 0 0 0 4px rgb(234 76 137 / 10%);
        }

        .icon {
            position: absolute;
            right: 14.4rem;
            fill: #9e9ea7;
            width: 1rem;
            height: 1rem;

        }

        .button {
            margin-right: 15px;
            padding:8px 25px;
            font-family: 'Tajawal', sans-serif;
            font-size: 15px;
            background-color: #f3f7fe;
            color: #192330;
            border: none;
            border-radius: 8px;
            transition: .3s;
        }

        .button:hover {
            background-color: #3b82f6;
            box-shadow: 0 0 0 5px #3b83f65f;
            color: #fff;
        }
</style>
