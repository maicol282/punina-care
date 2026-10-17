    <!-- ========== EXPLORACIÓN FÍSICA Y SISTEMAS ========== -->
    <div class="row">
        <!-- EXPLORACIÓN FÍSICA -->
        @php
            $exploraciones = [
                ['id' => 'cabeza', 'label' => 'Cabeza'], ['id' => 'cuello', 'label' => 'Cuello'],
                ['id' => 'torax', 'label' => 'Tórax'], ['id' => 'abdomen', 'label' => 'Abdomen'],
                ['id' => 'extremidades', 'label' => 'Extremidades'], ['id' => 'neurologico', 'label' => 'Neurológico'],
                ['id' => 'piel', 'label' => 'Piel'], ['id' => 'columna', 'label' => 'Columna'],
                ['id' => 'pelvis', 'label' => 'Pelvis'], ['id' => 'axilas', 'label' => 'Axilas'],
                ['id' => 'mamas', 'label' => 'Mamas']
            ];
            $tieneCP = collect($exploraciones)->contains(fn($e) => ($historial->{$e['id'].'_tipo'} ?? 'SP') === 'CP');
        @endphp
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm rounded-4 mb-4 h-100">
                <div class="card-header bg-transparent border-0 pt-4 pb-2 px-4 d-flex justify-content-between align-items-center">
                    <h6 class="fw-bold text-dark d-flex align-items-center mb-0">
                        <span class="icon-box bg-primary bg-opacity-10 text-primary rounded-3 me-2" style="width: 32px; height: 32px;"><i class="fas fa-male"></i></span>
                        Exploración Física
                    </h6>
                    <span class="badge {{ $tieneCP ? 'bg-danger' : 'bg-success' }} rounded-pill fw-normal">{{ $tieneCP ? 'Hallazgos patológicos' : 'Sin alteraciones' }}</span>
                </div>
                <div class="card-body p-4 pt-2">
                    <div class="row g-2">
                        @foreach($exploraciones as $exploracion)
                            @php
                                $campoTipo = $exploracion['id'] . '_tipo';
                                $esCP = ($historial->$campoTipo ?? 'SP') === 'CP';
                                $observacion = $historial->{$exploracion['id']} ?? '';
                            @endphp
                            <div class="col-md-6">
                                <div class="border rounded px-3 py-2 h-100 {{ $esCP ? 'border-danger bg-danger bg-opacity-10' : 'bg-light border-light' }}">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="small fw-semibold {{ $esCP ? 'text-danger' : 'text-muted' }}">{{ $exploracion['label'] }}</span>
                                        <span class="badge {{ $esCP ? 'bg-danger' : 'bg-secondary bg-opacity-25 text-secondary' }}" style="font-size: 10px;">{{ $esCP ? 'CP' : 'SP' }}</span>
                                    </div>
                                    @if($esCP && $observacion)
                                        <div class="text-dark mt-1" style="font-size: 12px; line-height: 1.3;">{{ $observacion }}</div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- REVISIÓN DE SISTEMAS -->
        @php
            $sistemas = [
                ['id' => 'cardiovascular', 'label' => 'Cardiovascular'], ['id' => 'respiratorio', 'label' => 'Respiratorio'],
                ['id' => 'digestivo', 'label' => 'Digestivo'], ['id' => 'renal', 'label' => 'Renal'],
                ['id' => 'neurologico', 'label' => 'Neurológico'], ['id' => 'musculoesqueletico', 'label' => 'Musculoesquelético'],
                ['id' => 'endocrino', 'label' => 'Endocrino'], ['id' => 'hematologico', 'label' => 'Hematológico'],
                ['id' => 'linfatico', 'label' => 'Linfático'], ['id' => 'genitourinario', 'label' => 'Genitourinario'],
                ['id' => 'piel', 'label' => 'Piel/Anexos'], ['id' => 'oftalmologico', 'label' => 'Oftalmológico'],
                ['id' => 'orl', 'label' => 'Otorrinolaringológico'], ['id' => 'psiquiatrico', 'label' => 'Psiquiátrico']
            ];
            $tieneCPSistemas = collect($sistemas)->contains(fn($s) => ($historial->{'sist_'.$s['id']} ?? 'SP') === 'CP');
        @endphp
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm rounded-4 mb-4 h-100">
                <div class="card-header bg-transparent border-0 pt-4 pb-2 px-4 d-flex justify-content-between align-items-center">
                    <h6 class="fw-bold text-dark d-flex align-items-center mb-0">
                        <span class="icon-box bg-secondary bg-opacity-10 text-secondary rounded-3 me-2" style="width: 32px; height: 32px;"><i class="fas fa-project-diagram"></i></span>
                        Órganos y Sistemas
                    </h6>
                    <span class="badge {{ $tieneCPSistemas ? 'bg-danger' : 'bg-success' }} rounded-pill fw-normal">{{ $tieneCPSistemas ? 'Hallazgos patológicos' : 'Sin alteraciones' }}</span>
                </div>
                <div class="card-body p-4 pt-2">
                    <div class="row g-2">
                        @foreach($sistemas as $sistema)
                            @php
                                $campo = 'sist_' . $sistema['id'];
                                $esCP = ($historial->$campo ?? 'SP') === 'CP';
                                $observacion = $historial->{$campo.'_obs'} ?? '';
                            @endphp
                            <div class="col-md-6">
                                <div class="border rounded px-3 py-2 h-100 {{ $esCP ? 'border-danger bg-danger bg-opacity-10' : 'bg-light border-light' }}">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="small fw-semibold {{ $esCP ? 'text-danger' : 'text-muted' }}">{{ $sistema['label'] }}</span>
                                        <span class="badge {{ $esCP ? 'bg-danger' : 'bg-secondary bg-opacity-25 text-secondary' }}" style="font-size: 10px;">{{ $esCP ? 'CP' : 'SP' }}</span>
                                    </div>
                                    @if($esCP && $observacion)
                                        <div class="text-dark mt-1" style="font-size: 12px; line-height: 1.3;">{{ $observacion }}</div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @if($historial->observaciones_sistemas)
                        <div class="mt-3 p-3 bg-light rounded border small text-dark">
                            <strong class="text-primary d-block mb-1"><i class="fas fa-info-circle me-1"></i> Observaciones adicionales:</strong>
                            {{ $historial->observaciones_sistemas }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
