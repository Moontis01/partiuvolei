class File{
    constructor(id){
        this.name = ''
        this.arrayStrAdd = ''
        this.arrayStrAdd1 = ''
        this.arrayStrAdd2 = false
        this.saveToAdd = ''
        this.linkGet = ''
        this.thContent = []
        this.allData = {}
        this.idDetail = id
        this.jumpDetail = ['id', 'status']
        this.arrayDetail = []
        this.numsDetail = ['created']
        this.createTh()
        this.getData()
    }

    getData(){
        let link = '../sys/api' + this.linkGet
        return fetch(link)
        .then(e=>e.json())
        .then(e=>{
            this.allData = e.mensagem;
            for(let i of e.mensagem){
                if(i.data){
                    let date = new Date(i.data * 1000 + 86400000);
                    i.data = date.toLocaleDateString("pt-BR");
                }
                
                let tr = document.createElement('tr');
                tr.classList.add('empty-line');
                tr.classList.add('table-line');
                tr.id = `key${i.id}`;
    
                for(let [key, value] of Object.entries(i)){
                    if(key != 'id' && key != '_name'){
                        let td = document.createElement('td');
                        td.classList.add(`td-${key}`);
    
                        if(key == 'status'){
                            let preStatus = value == 'active' ? true : false;
                            td.setAttribute("status", preStatus);
                            let td2 = document.createElement('td');
                            td2.innerHTML = `<button class="ver-detalhes" onclick="openDetail(${i.id})">Ver detalhes</button>`;
                            tr.appendChild(td2);
                        }
    
                        td.innerHTML = value;
                        tr.appendChild(td);
                    }
                }
                tabList.appendChild(tr)
            }
            tabList.innerHTML += "<tr class='empty-line table-line2' id='notData'><td></td><td style='text-align: center'>Nenhum dado encontrado</td><td></td></tr>";
    
            if(tabList.querySelectorAll('.table-line').length > 0){
                notData.classList.remove('table-line2');
            }
            let statusDiv = document.querySelectorAll(".td-status");
            let activevar = 0;
            let inactivevar = 0;

            for(let i of statusDiv){
                let statusI = i.getAttribute("status");
                if(statusI){
                    activevar++;
                } else {
                    inactivevar++;
                }
            }
            inactive.innerText = inactivevar;
            active.innerText = activevar;
        })
    }

    createTh(){
        let tr = document.createElement('tr');
    
        let hlo = document.querySelector('.header-list-out');
        let select = document.createElement('select');
        select.id = 'selectFilter';
    
        for(let i of this.thContent){
            if(i == 'status'){
                let th2 = document.createElement('th');
                tr.appendChild(th2);
            }
            let th = document.createElement('th');
            th.innerHTML = i;
            tr.appendChild(th);
    
            let option = document.createElement('option');
            option.value = i;
            option.innerHTML = i;
            select.appendChild(option);
        }
        headList.appendChild(tr);
        hlo.appendChild(select);
    }

    getDetails(){
        let link = '../sys/api/detalhes/' + this.name + '?id=' + this.idDetail
        return fetch(link)
        .then(e=>e.json())
        .then(e=>{
            if(!e.response){
                newMsg(e);
                return;
            }
            details.classList.add("add-active");
            btnRemove.onclick = () => {
                this.removeSec();
            }
    
            i = e.mensagem[0];
            console.log(i.allTurmas);
    
            for(let [key, value] of Object.entries(i)){
                if(key == 'turmas'){
                    let value2 = i.allTurmas
                    for(j in value2){
                        value2[j].checked = 0;
                        value2[j] = JSON.stringify(value2[j]);
                    }
                    value2 = value2.join("#");
                    this.arrayStrAdd2 = value2;
                    this.saveToAdd = 'arrayStrAdd2';
                }
                if(this.numsDetail.includes(key)){
                    value = (new Date(value * 1000 + 86400000)).toLocaleDateString("pt-BR");
                }
                if(this.arrayDetail.includes(key)){
                    for(j in value){
                        if(key == 'alunos'){
                            value[j].checked = 0;
                        }
                        value[j] = JSON.stringify(value[j]);
                    }
                    value = value.join("#");
                    if(key == 'alunos'){
                        verPresencaBt.setAttribute('onclick', `verMais(this, 1, "Chamada")`);
                        this.arrayStrAdd = value;
                        this.arrayStrAdd1 = value;
                        this.saveToAdd = 'arrayStrAdd1';
                    }
                    value = `<button id='${key}BtDetail' class='btn-add' onclick='verMais(0, "${key}")'>Ver ${key}</button>`;
                }
                if(!this.jumpDetail.includes(key)){
                    document.getElementById(`${key}Get`).innerHTML = value.toString();
                }
            }
        })
    }

    removeSec(){
        let link = '../sys/api/extra/remove?local=' + this.name + '&id=' + this.idDetail
        fetch(link)
        .then(e=>e.json())
        .then(e=>{
            newMsg(e);
        })
    }
}

class Alunos extends File{
    constructor(id){
        super(id)
        this.name = 'alunos'
        this.linkGet = 'usuarios/get/alunos'
        this.thContent = ['nome', 'email', 'nascimento', 'status']
        this.jumpDetail.push('allTurmas')
        this.numsDetail.push('nascimento')
        this.arrayDetail.push('turmas')
    }
}

class Categorias extends File{
    constructor(id){
        super(id)
        this.name = 'categorias'
        this.linkGet = 'usuarios/get/categorias'
        this.thContent = ['nome', 'turmas', 'status']
        // this.jumpDetail.push()
        // this.numsDetail.push()
        // this.arrayDetail.push()
    }
}

class Eventos extends File{
    constructor(id){
        super(id)
        this.name = 'eventos'
        this.linkGet = 'turmas/get/eventos'
        this.thContent = ['nome', 'turma','categoria', 'data', 'status']
        // this.jumpDetail.push()
        this.numsDetail.push('data')
        this.arrayDetail.push('turmas')
    }
}

class Profissionais extends File{
    constructor(id){
        super(id)
        this.name = 'alunos'
        this.linkGet = 'usuarios/get/profissionais'
        this.thContent = ['nome', 'email', 'nascimento', 'titularidade', 'status']
        this.jumpDetail.push('allTurmas', 'imagem')
        this.numsDetail.push('nascimento')
        this.arrayDetail.push('turmas')
    }
}

class Recados extends File{
    constructor(id){
        super(id)
        this.name = 'alunos'
        this.linkGet = 'recados/get.php'
        this.thContent = ['from', 'to', 'status']
        // this.jumpDetail.push()
        // this.numsDetail.push()
        // this.arrayDetail.push()
    }
}

class Turmas extends File{
    constructor(id){
        super(id)
        this.name = 'alunos'
        this.linkGet = 'turmas/get/turmas'
        this.thContent = ['nome', 'categoria', 'profissionais', 'alunos', 'status']
        // this.jumpDetail.push()
        this.numsDetail.push('horario')
        this.arrayDetail.push('profissionais', 'alunos')
    }
}