<x-app-layout>
    <div class="card my-4">
        <div class="card-body">
            <x-auth-validation-errors class="mb-3" :errors="$errors" />
            <form id="noteform" action="{{ route('notes') }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="fichier" class="form-label">Fichier</label>
                        <input type="file" class="form-control" id="fichier" name="fichier"></input>
                    </div>
                    <div class="mb-3">
                        <label for="libelle" class="form-label">Libelle</label>
                        <input class="form-control" id="libelle" name="libelle"></input>
                    </div>
                    <div class="row mb-3">
                        <div class="col">PN:</div>
                        <div class="col form-check">
                            <input class="form-check-input" type="radio" name="pn" id="PNC" value="PNC">
                            <label class="form-check-label" for="PNC">
                                PNC
                            </label>
                        </div>
                        <div class="col form-check">
                            <input class="form-check-input" type="radio" name="pn" id="PNT" value="PNT">
                            <label class="form-check-label" for="PNT">
                                PNT
                            </label>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">Base:</div>
                        <div class="col form-check">
                            <input class="form-check-input" type="radio" name="base" id="TUN" value="TUN">
                            <label class="form-check-label" for="TUN">
                                TUN
                            </label>
                        </div>
                        <div class="col form-check">
                            <input class="form-check-input" type="radio" name="base" id="DJR" value="DJR">
                            <label class="form-check-label" for="DJR">
                                DJR
                            </label>
                        </div>
                        <div class="col form-check">
                            <input class="form-check-input" type="radio" name="base" id="MIR" value="MIR">
                            <label class="form-check-label" for="MIR">
                                MIR
                            </label>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">Secteur:</div>
                        <div class="col form-check">
                            <input class="form-check-input" type="radio" name="secteur" id="A32" value="A32">
                            <label class="form-check-label" for="A32">
                                A32
                            </label>
                        </div>
                        <div class="col form-check">
                            <input class="form-check-input" type="radio" name="secteur" id="36" value="36">
                            <label class="form-check-label" for="36">
                                36
                            </label>
                        </div>
                        <div class="col form-check">
                            <input class="form-check-input" type="radio" name="secteur" id="737" value="737">
                            <label class="form-check-label" for="737">
                                737
                            </label>
                        </div>
                        <div class="col form-check">
                            <input class="form-check-input" type="radio" name="secteur" id="80C" value="80C">
                            <label class="form-check-label" for="80C">
                                80C
                            </label>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">Note service:</div>
                        <div class="col form-check">
                            <input class="form-check-input" type="radio" name="note" id="high"
                                value="high">
                            <label class="form-check-label" for="high">
                                High level
                            </label>
                        </div>
                        <div class="col form-check">
                            <input class="form-check-input" type="radio" name="note" id="medium"
                                value="medium">
                            <label class="form-check-label" for="medium">
                                Medium level
                            </label>
                        </div>
                        <div class="col form-check">
                            <input class="form-check-input" type="radio" name="note" id="low"
                                value="low">
                            <label class="form-check-label" for="low">
                                Low level
                            </label>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal -->
    <div id="myModal" class="modal" tabindex="-1" x-data="{ hasAccepted: false }">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input @click="hasAccepted = !hasAccepted" type="checkbox" name="terms" id="terms">
                    <label>J'ai lu et j'accepte.</label>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button id="confirm" type="button" class="btn btn-primary"
                        :class="!hasAccepted && 'disabled'">Save
                        changes</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('#noteform').submit(e => {
            e.preventDefault();
            const data = $('form#noteform').serializeArray();
            console.log(data);
            const note = data.find(d => d.name === 'note').value;
            if (note === 'high') {
                var myModal = new bootstrap.Modal(document.getElementById('myModal'), {
                    keyboard: false
                });
                myModal.show();
                $('#confirm').on('click', function(event) {
                    e.currentTarget.submit();
                })
            } else {
                e.currentTarget.submit();
            }
        })
    </script>
</x-app-layout>
