<x-app-layout>
    <style>

    </style>
    <div class="card my-4">
        <div class="card-body" x-data="createEmptyDemande()" x-cloak>
            <div class="row justify-content-between">
                <div class="col justify-content-start">
                    <h3>Demandes</h3>
                </div>
                <div class="col ">
                    <div class="row justify-content-end">
                        <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal"
                            @click="selected = new Demande()" class="no-print btn btn-primary w-25">Add</button>
                        <button type="button" @click="printDiv()"
                            class="no-print btn btn-primary w-25 mx-4">Print</button>
                    </div>
                </div>
            </div>

            <form method="GET" action="{{ route('demandes') }}">
                <div class="mb-2 d-flex align-items-center">

                    <div class="position-relative">
                        <span class="position-absolute search"><i class="fa fa-search"></i></span>
                        <input class="form-control w-100" placeholder="Search by id#" name="search" id="search"
                            value="{{ $term }}">
                    </div>

                    <div class="px-2">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>



                    <div class="px-2">

                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Type
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item" href="?type=">Show All</a></li>
                                <li><a class="dropdown-item" href="?type=conge">Conge</a></li>
                                <li><a class="dropdown-item" href="?type=vol">Vol</a></li>
                                <li><a class="dropdown-item" href="?type=rotation">Rotation</a></li>
                            </ul>
                        </div>

                    </div>

                </div>
            </form>
            <div class="table-responsive" x-ref="container">
                <table id="table" class="table table-responsive">

                    <thead>
                        <tr class="bg-light">
                            <th class="checkbox-col" scope="col" width="5%"><input class="form-check-input"
                                    type="checkbox"></th>
                            <th scope="col" width="5%">#</th>
                            <th scope="col" width="10%">Type</th>
                            <th scope="col" width="20%">Date debut</th>
                            <th scope="col" width="20%">Date fin</th>
                            <th class="text-truncate comment" scope="col" width="10%">Matricule</th>
                            <th class="text-truncate comment" scope="col" width="10%">Commentaires</th>
                            <th class="actions"scope="col" class="text-end" width="20%"><span>Actions</span></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($demandes as $demande)
                            <tr>
                                <th class="checkbox-field" scope="row"><input class="form-check-input"
                                        type="checkbox"></th>
                                <td>{{ $demande->id }}</td>
                                <td>{{ $demande->type }}</td>
                                <td>
                                    @if ($demande->date_debut)
                                        {{ $demande->date_debut }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    @if ($demande->date_fin)
                                        {{ $demande->date_fin }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>{{ $demande->matricule }}</td>
                                <td><span class="text-truncate">{{ $demande->commentaire }}</span>
                                </td>
                                <td class="text-end action-btns">
                                    <button class="btn btn-outline-primary" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal" @click="selected = {{ $demande }}"> <i
                                            class="fa fa-pencil mr-2"></i><span class="fw-bolder">Edit</span></button>
                                    <button type="button" class="btn btn-outline-danger"
                                        onclick="
                                    var result = confirm('Are you sure you want to delete this record?');
                                    
                                    if(result){
                                        event.preventDefault();
                                        document.getElementById('delete-form-{{ $demande->id }}').submit();
                                    }"><i
                                            class="fa fa-trash mr-2"></i>Delete</button>
                                    <form method="POST" id="delete-form-{{ $demande->id }}"
                                        action="{{ route('demandes.destroy', [$demande->id]) }}">
                                        @method('DELETE')
                                        @csrf
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <p>No users</p>
                        @endforelse

                    </tbody>
                </table>
            </div>
            <!-- Button trigger modal -->

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"
                                x-text="selected ? 'Modifier':'Ajouter nouveau'">Modal
                                title</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form action="{{ route('demandes') }}" method="post">
                            @csrf
                            <input type="hidden" id="id" name="id" x-model="selected.id">
                            <div class="modal-body">
                                {{-- <p x-text="JSON.stringify(selected)"></p> --}}

                                <div class="mb-3">
                                    <p>Type:</p>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="type" id="conge"
                                            value="conge" x-model="selected.type">
                                        <label class="form-check-label" for="conge">
                                            Conge
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="type" id="vol"
                                            value="vol" x-model="selected.type">
                                        <label class="form-check-label" for="vol">
                                            Vol
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="type" id="rotation"
                                            value="rotation" x-model="selected.type">
                                        <label class="form-check-label" for="rotation">
                                            Rotation
                                        </label>
                                    </div>
                                </div>
                                <div class="row mb-3" x-show="selected.type == 'conge'">
                                    <div class="col">
                                        <label for="date_debut">Date debut:</label>
                                        <input type="date" id="date_debut" name="date_debut"
                                            x-model="selected.date_debut" class="form-control">
                                    </div>
                                    <div class="col">
                                        <label for="date_fin">Date fin:</label>
                                        <input type="date" id="date_fin" name="date_fin" class="form-control"
                                            x-model="selected.date_fin">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="commentaire" class="form-label">Commentaire</label>
                                    <textarea class="form-control" id="commentaire" name="commentaire" rows="3" x-model="selected.commentaire"></textarea>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        class Demande {
            constructor(id, type, date_debut, date_fin, commentaire) {
                this.id = id || '';
                this.type = type || '';
                this.date_debut = date_debut || '';
                this.date_fin = date_fin || '';
                this.commentaire = commentaire || '';
            }
        }

        createEmptyDemande = () => {
            return {
                selected: new Demande(),
                printDiv() {
                    var printContents = this.$refs.container.innerHTML;
                    var originalContents = document.body.innerHTML;
                    document.body.innerHTML = printContents;
                    window.print();
                    document.body.innerHTML = originalContents;
                }
            };
        }
    </script>
</x-app-layout>
