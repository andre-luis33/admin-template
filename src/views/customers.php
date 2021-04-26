<?php

title(
   'far fa-id-card',
   'Clientes',
   'Tenha um overview do todos os clientes de sua empresa!'
);

?>

<div class="filter-row">
   <h2>Filtros:</h2>
   <div class="form-group">
      <div class="form-row">
         <div class="col-md-3">
            <label>Nome</label>
            <input type="text" class="form-control" placeholder="Nome do Cliente" id="customer-name">
         </div>

         <div class="col-md-3">
            <label>País</label>
            <select id="country" class="form-control"></select>
         </div>

         <div class="col-md-3">
            <label>Colaborador Representante</label>
            <select id="employee-rep" class="form-control"></select>
         </div>
      </div>
   </div>
</div>


<table class="table table-striped table-hover">
   <thead>
      <td>ID</td>
      <td>Nome</td>
      <td>Telefone</td>
      <td>País</td>
      <td>Colaborador Rep</td>
      <td>Limite Creditário</td>
   </thead> 
   <tbody>

   </tbody>
</table>


<script>
   $(document).ready(function(){
      const authKey = 'g24Kw!2#BN0fAfMj89'
      
      let colspan = $('thead td').length
      let tbody = $('tbody')

      let inputCustomerName = $('#customer-name')
      let selectCountry = $('#country')
      let selectEmployee = $('#employee-rep')

      function getClients() {
         var data
         tableWaitingResponse('tbody', colspan, 'html')

         $.ajax({
            url: 'api/customers',
            method: 'GET', 
            beforeSend: function(request) {
               request.setRequestHeader("auth-key", authKey);
            },
            async: false,
            data: {
               type: 'get-data',
               offset: '0'
            },
            success: res => {
               data = JSON.parse(res)
            },
            error: () => {
               data = false
               callAlert('danger', 'Erro ao exibir clientes!')
            }
         })

         return data.data
      }

      function printClients(clients) {
         tbody.html('')

         for(let i in clients) {
            let { customerNumber, customerName, phone, country, employeeName, creditLimit } = clients[i]

            tbody.append(`<tr>
               <td>${customerNumber}</td>
               <td>${customerName}</td>
               <td>${phone}</td>
               <td>${country}</td>
               <td>${employeeName}</td>
               <td>$ ${creditLimit}</td>
            </tr>`)
         }
      }

      function filterClients(clients){
         let clientsFiltered = clients

         let name = inputCustomerName.val()
         let employee = selectEmployee.val()
         let country = selectCountry.val()

         if(name != '')
            clientsFiltered = clientsFiltered.filter(item => item.customerName.toLowerCase().indexOf(name) > -1)

         if(country != '')
            clientsFiltered = clientsFiltered.filter(item => item.country == country)

         if(employee != '')
            clientsFiltered = clientsFiltered.filter(item => item.employeeName == employee)

         printClients(clientsFiltered)
      }



      function fillSelect(json) {

         let countrys = json.map(array => array.country)
         countrys = countrys.filter((x, i, a) => a.indexOf(x) == i)
         countrys = countrys.sort((a, b) => a.localeCompare(b))

         let employeeNames = json.map(array => array.employeeName)
         employeeNames = employeeNames.filter((x, i, a) => a.indexOf(x) == i)
         employeeNames = employeeNames.sort((a, b) => a.localeCompare(b))

         selectCountry.html('<option value="">Escolher</option>')
         selectEmployee.html('<option value="">Escolher</option>')
         
         for(let i in countrys) 
            selectCountry.append(`
               <option>${countrys[i]}</option>
            `)
         
         for(let i in employeeNames) 
            selectEmployee.append(`
               <option>${employeeNames[i]}</option>
            `)
         
      }

      
      let clients = getClients()
      printClients(clients)
      fillSelect(clients)
      
      inputCustomerName.keyup(() => filterClients(clients))
      selectCountry.change(() => filterClients(clients))
      selectEmployee.change(() => filterClients(clients))
   })
</script>

<style>
   .filter-row {
      background-color: var(--bg-boxes);
      color: var(--color-boxes);

      padding: 10px;
      border-radius: 10px;
      margin-bottom: 10px;
   }
</style>