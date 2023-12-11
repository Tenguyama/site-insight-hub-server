@php use Illuminate\Support\Facades\Auth; @endphp
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card add_site">
            <div class="card-header">Warning!</div>
            <div class="card-body">
                <p>Before adding any code to the client's website, you need to add a connection script with your own
                    hands!</p>
                <div class="card">
                    <div class="card-header">
                        <a class="link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover"
                           href="http://localhost:8080/storage/connect.js" download>Download connect.js</a>
                    </div>
                    <div class="card-body">
                        <p>In your js folder paste connect.js file:</p>
                        <code>
                        <pre>
    // connect.js
    var scriptTag = document.createElement('script');
    scriptTag.src = 'http://localhost:8080/storage/versatile.js';
    document.body.appendChild(scriptTag);</pre>
                        </code>
                        <p class="mt-4">In your html file, add this code before the closing body tag:</p>
                        <code>
                        <pre>
         &lt;script src="js/connect.js"&gt;&lt;/script&gt;
    &lt;/body&gt;</pre>
                        </code>
                    </div>
                </div>
            </div>
        </div>
        {{--    Форма додавання сайту до списку користувацьких сайтів    --}}
        <div class="card mt-4 add_site">
            <div class="card-header">Add site</div>
            <div class="card-body text-md-center">
                <form id="addSiteForm" novalidate>
                    <div class="mb-3 text-md-start">
                        <label for="siteUrl" class="form-label">Site URL</label>
                        <input type="url" class="form-control" id="siteUrl" name="siteUrl"
                               placeholder="Enter site page URL: https://www.example.com/pages/example-page.html"
                               required>
                        <div class="invalid-feedback">
                            Please enter a valid URL.
                        </div>
                    </div>
                    <div class="mb-3 text-md-start">
                        <label for="siteName" class="form-label">Site Name</label>
                        <input type="text" class="form-control" id="siteName" name="siteName"
                               placeholder="Enter site name: www.example.com" required>
                        <div class="invalid-feedback">
                            Please enter a site name.
                        </div>
                    </div>
                    <p class="text-md-start">PS: use "host.docker.internal" instead of your localhost address
                        (127.0.0.1), i.e. 127.0.0.1:5500 (standard LiveServer in VSCode) will look like this
                        host.docker.internal:5500</p>
                    <p class="text-md-start">PS PS: this is a problem only for locally raised "sites" outside the
                        locally raised docker container</p>
                    <div class="flex-row">
                        <button type="button" class="btn btn-primary" onclick="checkButtonClick()">Check</button>
                        <button type="button" class="btn btn-secondary" onclick="backButtonClick()">Back to list of site
                        </button>
                    </div>
                </form>
            </div>
        </div>
        {{-- Форма для виводу доданого користувачем сайту --}}
        <div class="card mt-4 hidden added_site">
            <div class="card-header">Added site</div>
            <div class="card-body text-md-center">
                <div class="mb-3 text-md-start">
                    <label for="siteUrl" class="form-label">Site URL</label>
                    <p id="addedSiteUrl"></p>
                </div>
                <div class="mb-3 text-md-start">
                    <label for="siteName" class="form-label">Site Name</label>
                    <p id="addedSiteName"></p>
                </div>
            </div>
        </div>
        {{-- Форма для додавання користувачем таргетів (цілей) для сайту --}}
        <div class="card mt-4 hidden added_site edit_target">
            <div class="card-header">Add target for this site</div>
            <div class="card-body text-md-center">
                <form id="addTargetForm" novalidate>
                    <div class="mb-3 text-md-start">
                        <label for="elementType" class="form-label">Choose HTML Element Type</label>
                        <select class="form-select" id="addElementType" aria-label="HTML Element Type">
                            <option value="tag">Tag</option>
                            <option value="id">ID</option>
                            <option value="class">Class</option>
                            <option value="url">URL</option>
                            <option value="text">Text</option>
                        </select>
                    </div>
                    <div class="mb-3 text-md-start">
                        <label for="identificationType" class="form-label">Choose Identification Type</label>
                        <select class="form-select" id="addIdentificationType" aria-label="Identification Type">
                            <option value="contains">Contains</option>
                            <option value="notContains">Does Not Contain</option>
                            <option value="equals">Equals</option>
                            <option value="startsWith">Starts With</option>
                        </select>
                    </div>
                    <div class="mb-3 text-md-start">
                        <label for="identificationText" class="form-label">Enter Text for Identification</label>
                        <input type="text" class="form-control" id="addIdentificationText">
                    </div>

                    <button type="button" class="btn btn-primary" onclick="addTargetButtonClick()">Add target</button>

                    <div id="targetTableContainer"></div>

                    <div class="flex-row mt-3">
                        <button type="button" class="btn btn-secondary" onclick="skipButtonClick()">Skip</button>
                        <button type="button" class="btn btn-success" onclick="saveButtonClick()">Save</button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Форма для редагування таргету --}}
        <div class="card mt-4 hidden edit_target">
            <div class="card-header">Editing target</div>
            <div class="card-body text-md-center">
                <form id="editTargetForm" novalidate>
                    <div class="mb-3 text-md-start">
                        <label for="elementType" class="form-label">Choose HTML Element Type</label>
                        <select class="form-select" id="editElementType" aria-label="HTML Element Type">
                            <option value="tag">Tag</option>
                            <option value="id">ID</option>
                            <option value="class">Class</option>
                            <option value="url">URL</option>
                            <option value="text">Text</option>
                        </select>
                    </div>
                    <div class="mb-3 text-md-start">
                        <label for="identificationType" class="form-label">Choose Identification Type</label>
                        <select class="form-select" id="editIdentificationType" aria-label="Identification Type">
                            <option value="contains">Contains</option>
                            <option value="notContains">Does Not Contain</option>
                            <option value="equals">Equals</option>
                            <option value="startsWith">Starts With</option>
                        </select>
                    </div>
                    <div class="mb-3 text-md-start">
                        <label for="identificationText" class="form-label">Enter Text for Identification</label>
                        <input type="text" class="form-control" id="editIdentificationText">
                    </div>
                    <div class="flex-row">
                        <button type="button" class="btn btn-primary" onclick="editTarget()">Edit target</button>
                        <button type="button" class="btn btn-secondary" onclick="backToAddTargetButtonClick()">Back to
                            list of target
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
    <script>
        let site = Object;
        let targets = Object;
        let editingTarget = Object;

        const addSiteForm = document.getElementById('addSiteForm');
        Array.from(addSiteForm.elements).forEach(element => {
            element.addEventListener('input', function () {
                this.classList.remove('is-invalid');
            });
        });


        function backButtonClick() {
            window.location.href = '/sites';
        }

        function checkButtonClick() {
            const form = document.getElementById('addSiteForm');
            clearInput();
            if (form.checkValidity()) {
                const siteUrl = document.getElementById('siteUrl').value;
                const siteName = document.getElementById('siteName').value;

                axios.post('{{ url('/api/v1/search-code') }}', {
                    url: siteUrl
                }, {
                    headers: {
                        Authorization: `Bearer ${'{{ Auth::user()->createToken("token-name")->plainTextToken }}'}`
                    }
                })
                    .then(response => {
                        if (response.data) {
                            addSite(siteName, siteUrl);
                        } else {
                            alert("You have not added connect.js to your website page");
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            } else {
                Array.from(form.elements).forEach(element => {
                    if (element.checkValidity() === false) {
                        element.classList.add('is-invalid');
                    }
                });
            }
        }

        function clearInput() {
            Array.from(addSiteForm.elements).forEach(element => {
                element.classList.remove('is-invalid');
            });
        }

        function addSite(siteName, siteUrl) {
            {{--console.log('{{Auth::user()->id}}');--}}
            axios.post('{{ url('/api/v1/site') }}', {
                name: siteName,
                url_page: siteUrl,
                user_id: {{Auth::user()->id}}
            }, {
                headers: {
                    Authorization: `Bearer ${'{{ Auth::user()->createToken("token-name")->plainTextToken }}'}`
                }
            })
                .then(response => {
                    checked = response.data;
                    if (response.data) {
                        if ('result' in checked) {
                            alert(checked.message);
                        } else {
                            site = response.data;
                            rebildPageAfterAddingSite();
                        }
                    } else {
                        alert("ERROR ADD SITE");
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }

        function rebildPageAfterAddingSite() {
            setText();

            let addElements = document.querySelectorAll('.add_site');
            addElements.forEach(function (addElement) {
                addElement.classList.toggle('hidden');
            });

            let addedElements = document.querySelectorAll('.added_site');
            addedElements.forEach(function (addedElement) {
                addedElement.classList.toggle('hidden');
            });

            getAllSiteTargets();
        }

        function setText() {
            let siteUrl = document.querySelector('#addedSiteUrl');
            let siteName = document.querySelector('#addedSiteName');
            siteUrl.textContent = site.url_page;
            siteName.textContent = site.name;
        }

        function addTargetButtonClick() {
            const form = document.getElementById('addTargetForm');
            clearInput();
            if (form.checkValidity()) {
                const inputElement = document.getElementById('addIdentificationText');
                const search_type = document.getElementById('addElementType').value;
                const identified = document.getElementById('addIdentificationType').value;
                const search_value = inputElement.value;
                inputElement.value = '';
                addTarget(search_type, identified, search_value);
            } else {
                Array.from(form.elements).forEach(element => {
                    if (element.checkValidity() === false) {
                        element.classList.add('is-invalid');
                    }
                });
            }
        }

        function addTarget(search_type, identified, search_value) {
            axios.post('{{ url('/api/v1/target') }}', {
                search_type: search_type,
                identified: identified,
                search_value: search_value,
                site_id: site.id
            }, {
                headers: {
                    Authorization: `Bearer ${'{{ Auth::user()->createToken("token-name")->plainTextToken }}'}`
                }
            })
                .then(response => {
                    if (response.data) {
                        // targets  += [response.data];
                        getAllSiteTargets();
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }

        function rebildPageToEditTarget() {
            let addElements = document.querySelectorAll('.edit_target');
            addElements.forEach(function (addElement) {
                addElement.classList.toggle('hidden');
            });
            getAllSiteTargets();
        }

        function editTargetButtonClick(id) {
            console.log(id);

            axios.get('{{ url('/api/v1/target') }}/' + id, {
                headers: {
                    Authorization: `Bearer ${'{{ Auth::user()->createToken("token-name")->plainTextToken }}'}`
                }
            })
                .then(response => {
                    if (response.data) {
                        editingTarget = response.data;
                        rebildPageToEditTarget();
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }

        function editTarget() {
            const form = document.getElementById('editTargetForm');

            clearInput();
            if (form.checkValidity()) {
                const inputElement = document.getElementById('editIdentificationText');
                const search_type = document.getElementById('editElementType').value;
                const identified = document.getElementById('editIdentificationType').value;
                const search_value = inputElement.value;
                inputElement.value = '';
                axios.put('{{ url('/api/v1/target') }}/' + editingTarget.id, {
                    search_type: search_type,
                    identified: identified,
                    search_value: search_value,
                    site_id: editingTarget.site_id,
                }, {
                    headers: {
                        Authorization: `Bearer ${'{{ Auth::user()->createToken("token-name")->plainTextToken }}'}`
                    }
                })
                    .then(response => {
                        if (response.data) {
                            rebildPageToEditTarget()
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            } else {
                Array.from(form.elements).forEach(element => {
                    if (element.checkValidity() === false) {
                        element.classList.add('is-invalid');
                    }
                });
            }
        }

        function deleteTargetButtonClick(id) {
            if (confirm("Are you sure you want to remove this target from the list of targets for this site?")) {
                deleteTarget(id);
                // саме з делітом криво працює(
                getAllSiteTargets();
            } else {
                alert("Your target has not been removed from the list");
            }
        }

        function deleteTarget(id) {
            axios.delete('{{ url('/api/v1/target') }}/' + id, {
                headers: {
                    Authorization: `Bearer ${'{{ Auth::user()->createToken("token-name")->plainTextToken }}'}`
                }
            })
                .then(response => {
                    getAllSiteTargets()
                    console.log(response.data);
                })
                .catch(error => {
                    console.error(error);
                });
        }

        function getAllSiteTargets() {
            axios.get("{{ url('/api/v1/site/') }}/" + site.id + '/targets')
                .then(response => {
                    if (response.data) {
                        targets = response.data
                        console.log(targets);
                        reloadTable();
                    } else {
                        alert("ERROR TARGETS");
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }

        function reloadTable() {
            let tableContainer = document.getElementById('targetTableContainer');
            tableContainer.innerHTML = '';
            if (Array.isArray(targets) && targets.length > 0) {
                let table = document.createElement('table');
                table.classList.add('table');
                let headerRow = table.insertRow();
                headerRow.innerHTML = '<th scope="col">Type</th><th scope="col">Identified</th><th scope="col">Values</th><th scope="col">Actions</th>';
                targets.forEach(function (target) {
                    let row = table.insertRow();
                    row.innerHTML = '<td>' + target.search_type + '</td><td>' + target.identified + '</td><td>' + target.search_value + '</td><td>' +
                        '<div class="flex-row">' +
                        '<button type="button" class="btn btn-primary" onclick="editTargetButtonClick(' + target.id + ')">Edit</button>' +
                        '<button type="button" class="btn btn-danger" onclick="deleteTargetButtonClick(' + target.id + ')">Delete</button>' +
                        '</div>' +
                        '</td>';
                });
                tableContainer.appendChild(table);
            } else {
                let noTargetsMessage = document.createElement('p');
                noTargetsMessage.textContent = "It looks like you don't have a single target for this website";
                tableContainer.appendChild(noTargetsMessage);
            }
        }

        function backToAddTargetButtonClick() {
            rebildPageToEditTarget();
        }

        async function skipButtonClick() {
            if (targets.length > 0) {
                for (const target of targets) {
                    await deleteTarget(target.id);
                }
            }
            //КОСТИЛЬ
            await new Promise(resolve => setTimeout(resolve, 1000));
            window.location.href = '/sites';
        }

        function saveButtonClick() {
            window.location.href = '/sites';
        }
    </script>

    <style>
        .hidden {
            display: none;
        }
    </style>
@endsection
