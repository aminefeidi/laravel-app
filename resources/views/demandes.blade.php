<x-app-layout>
    <div class="card my-4">
        <div class="card-body" x-data="createEmptyDemande()">
            <div class="row justify-content-between">
                <div class="col justify-content-start">
                    <h3>Demandes</h3>
                </div>
                <div class="col ">
                    <div class="row justify-content-end"><button type="button" data-bs-toggle="modal"
                            data-bs-target="#exampleModal" @click="selected = new Demande()"
                            class="btn btn-primary w-25">Add</button>
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
                                <li><a class="dropdown-item" href="?type=conge">Conge</a></li>
                                <li><a class="dropdown-item" href="?type=vol">Vol</a></li>
                                <li><a class="dropdown-item" href="?type=rotation">Rotation</a></li>
                            </ul>
                        </div>

                    </div>

                </div>
            </form>
            <div class="table-responsive">
                <table class="table table-responsive table-borderless">

                    <thead>
                        <tr class="bg-light">
                            <th scope="col" width="5%"><input class="form-check-input" type="checkbox"></th>
                            <th scope="col" width="5%">#</th>
                            <th scope="col" width="20%">Type</th>
                            <th scope="col" width="10%">Date debut</th>
                            <th scope="col" width="10%">Date fin</th>
                            <th scope="col" width="30%">Commentaires</th>
                            <th scope="col" class="text-end" width="20%"><span>Actions</span></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($demandes as $demande)
                            <tr>
                                <th scope="row"><input class="form-check-input" type="checkbox"></th>
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
                                <td>{{ $demande->commentaire }}</td>
                                <td class="text-end">
                                    <button class="btn btn-outline-primary" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal" @click="selected = {{ $demande }}"> <i
                                            class="fa fa-pencil mr-2"></i><span class="fw-bolder">Edit</span></button>
                                    <button type="button" class="btn btn-outline-danger"><i
                                            class="fa fa-trash mr-2"></i>Delete</button>
                                </td>
                            </tr>
                        @empty
                            <p>No users</p>
                        @endforelse

                    </tbody>
                </table>
            </div>
            <!-- Button trigger modal -->

            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Launch demo modal
            </button>

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
                        <div class="modal-body">
                            <p x-text="JSON.stringify(selected)"></p>
                            <form action="{{ route('demandes') }}" method="post">
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
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
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
                selected: new Demande()
            };
        }
    </script>
</x-app-layout>