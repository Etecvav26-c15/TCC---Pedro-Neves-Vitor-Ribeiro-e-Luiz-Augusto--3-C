# Centro Paula Souza
## Etec Vasco Antônio Venchiarutti – Jundiaí - SP
### Técnico em Desenvolvimento de Sistemas – Junho/2026

Artigo desenvolvido na disciplina de Planejamento e Desenvolvimento do TCC em Desenvolvimento de Sistemas sob orientação dos professores Ronildo Aparecido Ferreira e Luciana Ferreira Baptista.

# SISTEMA ESCOLAR COM BANCO DE DADOS EM NUVEM PARA GERENCIAMENTO ACADÊMICO

**Luiz Augusto Caires Mantovani**  
**Pedro Neves Ovídio**  
**Vitor Nobrega Ribeiro**

# RESUMO

Este estudo tem o objetivo de desenvolver um sistema escolar com banco de dados em nuvem para facilitar o gerenciamento de informações acadêmicas em instituições de ensino. Dentre os autores pesquisados para a constituição conceitual deste trabalho, destacaram-se Souza et al. (2023), Lahm et al. (2020), Lück (2009), Libâneo (2018), Morgado e Távora (2023) e Santos (2022).

A metodologia utilizada foi a pesquisa exploratória, tendo como coleta de dados o levantamento bibliográfico e a observação de necessidades presentes no ambiente escolar.

As conclusões mais relevantes indicam que a utilização de bancos de dados em nuvem contribui para a segurança, acessibilidade e organização das informações acadêmicas, além de possibilitar integração entre plataformas web e dispositivos móveis, promovendo maior eficiência nos processos administrativos e pedagógicos.

Destaca-se ainda que a adoção de mecanismos de proteção de dados, como controle de acesso, autenticação de usuários, armazenamento seguro de credenciais, realização de backups periódicos e conformidade com princípios da Lei Geral de Proteção de Dados (LGPD), fortalece a confidencialidade, a integridade e a disponibilidade das informações acadêmicas, reduzindo riscos de perda, vazamento ou acesso não autorizado aos dados.

**Palavras-chave:** Tecnologia da Informação. Computação em Nuvem. Banco de Dados. Gestão Escolar. Segurança da Informação. Sistema Acadêmico.

# INTRODUÇÃO

Com o avanço da tecnologia e a crescente digitalização dos processos organizacionais, a utilização de sistemas informatizados tornou-se indispensável para a gestão eficiente das instituições de ensino.

A administração escolar envolve uma grande quantidade de informações relacionadas a alunos, professores, turmas, disciplinas, notas, frequência e documentos acadêmicos, exigindo mecanismos capazes de garantir organização, segurança e fácil acesso aos dados.

Entretanto, muitas instituições ainda utilizam métodos manuais ou sistemas limitados para armazenar e gerenciar essas informações, o que pode ocasionar dificuldades na recuperação de dados, atrasos nos processos administrativos, inconsistências nos registros e maior vulnerabilidade à perda de informações.

Segundo Lahm et al. (2020), os sistemas de informação desempenham papel essencial na otimização das atividades de gestão escolar, contribuindo para a melhoria dos processos administrativos e pedagógicos.

Nesse contexto, a computação em nuvem surge como uma alternativa tecnológica capaz de proporcionar maior flexibilidade, disponibilidade e segurança no armazenamento de dados.

Essa tecnologia permite que informações sejam acessadas remotamente por meio da internet, reduzindo a dependência de infraestrutura local e facilitando a integração entre diferentes usuários e dispositivos.

Além disso, soluções baseadas em nuvem apresentam vantagens relacionadas à escalabilidade, manutenção simplificada e redução de custos operacionais, tornando-se cada vez mais utilizadas em ambientes educacionais.

O presente estudo delimita-se ao desenvolvimento de um sistema escolar integrado a um banco de dados em nuvem, com foco no gerenciamento de alunos, professores, turmas, notas, frequência e demais informações acadêmicas.

O sistema é desenvolvido utilizando tecnologias web e mobile, permitindo que os usuários acessem os recursos da plataforma de forma prática e segura em diferentes dispositivos.

A proposta busca oferecer uma solução centralizada para o gerenciamento escolar, promovendo maior eficiência nos processos administrativos e acadêmicos.

O objetivo geral deste trabalho é desenvolver um sistema escolar utilizando banco de dados em nuvem para facilitar o gerenciamento das informações acadêmicas, promovendo segurança, organização, acessibilidade e agilidade no acesso aos dados.

## Objetivos Específicos

- Modelar e implementar um banco de dados capaz de armazenar informações acadêmicas de forma estruturada;
- Desenvolver uma interface intuitiva para os diferentes perfis de usuários;
- Implementar mecanismos de autenticação e proteção de dados;
- Disponibilizar funcionalidades que auxiliem na gestão das atividades escolares.

Esta pesquisa justifica-se pela crescente necessidade de modernização dos processos educacionais e pela importância da utilização de recursos tecnológicos que contribuam para a melhoria da gestão escolar.

A digitalização dos registros acadêmicos possibilita reduzir falhas operacionais, minimizar o uso de documentos físicos, otimizar o fluxo de informações e fortalecer a comunicação entre alunos, professores e administradores.

Além disso, a adoção de tecnologias em nuvem favorece a proteção dos dados armazenados por meio de mecanismos avançados de segurança, backup e recuperação de informações.

Dessa forma, o estudo apresenta relevância tanto do ponto de vista acadêmico quanto prático, ao demonstrar a aplicação de tecnologias modernas em um contexto educacional.

A metodologia utilizada neste trabalho caracteriza-se como uma pesquisa exploratória, desenvolvida por meio de levantamento bibliográfico e observação dos processos administrativos presentes em instituições de ensino.

Foram consultadas obras, artigos científicos e materiais técnicos relacionados à computação em nuvem, bancos de dados, desenvolvimento de sistemas e gestão escolar, buscando fundamentar teoricamente a proposta apresentada.

Paralelamente, foi realizado o desenvolvimento prático do sistema, envolvendo etapas de levantamento de requisitos, modelagem do banco de dados, implementação das funcionalidades, desenvolvimento da interface gráfica e realização de testes para validação dos recursos implementados.

Como resultado esperado, pretende-se disponibilizar uma ferramenta capaz de otimizar a gestão escolar por meio da centralização das informações acadêmicas em um ambiente seguro e acessível.

Espera-se que o sistema contribua para a redução do tempo gasto em atividades administrativas, aumente a confiabilidade dos registros acadêmicos e proporcione uma melhor experiência aos usuários, demonstrando o potencial das tecnologias em nuvem como suporte à transformação digital no setor educacional.

# COMPUTAÇÃO EM NUVEM E GERENCIAMENTO DE DADOS

Além da flexibilidade e da redução de custos, a computação em nuvem desempenha papel fundamental na segurança da informação.

Os principais provedores de serviços em nuvem utilizam mecanismos avançados de proteção, como:

- Criptografia de dados;
- Autenticação multifator;
- Monitoramento contínuo de acessos;
- Sistemas de detecção de ameaças.

Essas tecnologias contribuem para minimizar riscos relacionados a ataques cibernéticos, acessos não autorizados e perda de informações, aspectos cada vez mais relevantes em um cenário marcado pelo crescimento do volume de dados digitais.

Outro aspecto importante refere-se à facilidade de integração entre diferentes sistemas e plataformas.

A computação em nuvem permite que aplicações distintas compartilhem informações em tempo real, favorecendo a criação de ambientes mais conectados e eficientes.

No contexto educacional, essa integração possibilita a comunicação entre módulos acadêmicos, financeiros, administrativos e pedagógicos, promovendo maior consistência dos dados e reduzindo a necessidade de processos manuais de atualização de informações.

A mobilidade proporcionada pelos serviços em nuvem também representa um diferencial significativo.

Por meio de dispositivos conectados à internet, usuários podem acessar informações e executar tarefas independentemente de sua localização geográfica.

Essa característica tornou-se ainda mais relevante após a expansão do ensino remoto e híbrido, evidenciando a necessidade de plataformas capazes de oferecer acesso contínuo aos recursos educacionais.

# COMPUTAÇÃO EM NUVEM E GERENCIAMENTO DE DADOS

Além da flexibilidade e da redução de custos, a computação em nuvem desempenha papel fundamental na segurança da informação. Os principais provedores de serviços em nuvem utilizam mecanismos avançados de proteção, como criptografia de dados, autenticação multifator, monitoramento contínuo de acessos e sistemas de detecção de ameaças. Essas tecnologias contribuem para minimizar riscos relacionados a ataques cibernéticos, acessos não autorizados e perda de informações, aspectos cada vez mais relevantes em um cenário marcado pelo crescimento do volume de dados digitais.

Outro aspecto importante refere-se à facilidade de integração entre diferentes sistemas e plataformas. A computação em nuvem permite que aplicações distintas compartilhem informações em tempo real, favorecendo a criação de ambientes mais conectados e eficientes. No contexto educacional, essa integração possibilita a comunicação entre módulos acadêmicos, financeiros, administrativos e pedagógicos, promovendo maior consistência dos dados e reduzindo a necessidade de processos manuais de atualização de informações.

A mobilidade proporcionada pelos serviços em nuvem também representa um diferencial significativo. Por meio de dispositivos conectados à internet, usuários podem acessar informações e executar tarefas independentemente de sua localização geográfica. Essa característica tornou-se ainda mais relevante após a expansão do ensino remoto e híbrido, evidenciando a necessidade de plataformas capazes de oferecer acesso contínuo aos recursos educacionais. Dessa forma, gestores, professores e estudantes podem consultar informações acadêmicas, acompanhar atividades e realizar procedimentos administrativos de maneira rápida e eficiente.

Do ponto de vista estratégico, a computação em nuvem contribui para a transformação digital das instituições de ensino ao fornecer recursos tecnológicos capazes de apoiar a tomada de decisões baseada em dados. A centralização das informações permite a geração de relatórios, indicadores de desempenho e análises estatísticas que auxiliam gestores no planejamento de ações e na identificação de oportunidades de melhoria. Com isso, as instituições tornam-se mais preparadas para responder às demandas do ambiente educacional contemporâneo.

Adicionalmente, a utilização de soluções em nuvem favorece a sustentabilidade organizacional ao reduzir a necessidade de equipamentos físicos e a produção de documentos impressos. A diminuição do consumo de papel, energia elétrica e recursos destinados à manutenção de infraestrutura local contribui para práticas mais sustentáveis e alinhadas às exigências de responsabilidade ambiental presentes na sociedade atual.

Diante desse cenário, a computação em nuvem consolida-se como uma tecnologia indispensável para a evolução dos sistemas de gestão escolar. Sua capacidade de oferecer armazenamento seguro, acesso remoto, integração de informações, escalabilidade e redução de custos torna essa solução especialmente adequada para instituições de ensino que buscam modernizar seus processos administrativos e acadêmicos. Assim, a adoção dessa tecnologia representa não apenas uma inovação tecnológica, mas também uma estratégia capaz de promover maior eficiência, qualidade e competitividade no setor educacional.

# BANCO DE DADOS EM NUVEM E ARMAZENAMENTO DE INFORMAÇÕES ACADÊMICAS

Os bancos de dados representam a base estrutural de qualquer sistema de informação. Eles são responsáveis pelo armazenamento organizado das informações, permitindo consultas rápidas, atualizações seguras e recuperação eficiente dos dados. No contexto escolar, os bancos de dados armazenam informações relacionadas a alunos, professores, disciplinas, turmas, avaliações, frequências e documentos institucionais.

Segundo Elmasri e Navathe (2019), um banco de dados pode ser definido como uma coleção organizada de informações relacionadas entre si, projetada para atender às necessidades de uma determinada aplicação. Sua utilização permite reduzir redundâncias, aumentar a consistência dos dados e facilitar o compartilhamento de informações entre diferentes usuários.

Quando hospedados em ambientes de nuvem, os bancos de dados passam a oferecer vantagens adicionais. Entre elas destacam-se a alta disponibilidade, os mecanismos automatizados de backup, a recuperação de desastres e a escalabilidade dinâmica dos recursos computacionais.

Nas instituições de ensino, a utilização de bancos de dados em nuvem permite centralizar informações acadêmicas em uma única plataforma. Isso facilita o acesso aos registros escolares e reduz problemas decorrentes da utilização de planilhas isoladas ou documentos físicos.

Outro benefício importante está relacionado à integração de informações. Sistemas acadêmicos modernos permitem que diferentes módulos compartilhem dados automaticamente, evitando inconsistências e reduzindo a necessidade de lançamentos repetitivos.

Segundo Santos (2022), a combinação entre bancos de dados relacionais e não relacionais amplia a capacidade de armazenamento e processamento dos sistemas educacionais. Essa abordagem permite lidar tanto com informações estruturadas quanto com conteúdos mais complexos, como documentos digitais e registros multimídia.

A utilização de bancos de dados em nuvem também favorece a geração de relatórios gerenciais, permitindo que gestores acompanhem indicadores acadêmicos, índices de frequência e desempenho escolar de forma rápida e eficiente.

# SISTEMAS DE INFORMAÇÃO NA GESTÃO EDUCACIONAL

Os sistemas de informação desempenham papel fundamental na administração contemporânea. Sua principal função consiste em coletar, processar, armazenar e distribuir informações que auxiliem a tomada de decisões organizacionais.

Segundo Lahm et al. (2020), os sistemas de informação educacionais contribuem para a melhoria dos processos administrativos e pedagógicos, promovendo maior organização e eficiência na gestão escolar.

A utilização dessas ferramentas permite automatizar atividades que tradicionalmente exigiam grande quantidade de trabalho manual. Processos como matrícula, emissão de boletins, lançamento de notas e controle de frequência podem ser realizados de maneira mais rápida e confiável.

Além disso, os sistemas acadêmicos proporcionam maior transparência na comunicação entre escola, professores, alunos e responsáveis. O acesso digital às informações fortalece o acompanhamento do desempenho escolar e contribui para uma gestão mais participativa.

Outro aspecto relevante está relacionado à tomada de decisões baseada em dados. A partir das informações armazenadas no sistema, gestores podem identificar padrões, avaliar indicadores de desempenho e desenvolver estratégias para melhoria da qualidade educacional.

A crescente digitalização das instituições de ensino demonstra que os sistemas de informação deixaram de ser ferramentas complementares para se tornarem elementos essenciais da gestão escolar moderna.                        

# GESTÃO ESCOLAR E TRANSFORMAÇÃO DIGITAL

A gestão escolar moderna exige processos organizacionais cada vez mais eficientes para atender às demandas da sociedade contemporânea. O crescimento da utilização das tecnologias digitais tem provocado mudanças significativas na forma como as instituições administram seus recursos e conduzem suas atividades.

Segundo Lück (2009), a gestão escolar deve promover integração entre planejamento, organização, liderança e avaliação, buscando garantir a qualidade dos serviços educacionais oferecidos à comunidade.

Nesse cenário, a transformação digital surge como um importante instrumento de apoio à administração escolar. A utilização de sistemas informatizados possibilita maior controle das atividades acadêmicas e administrativas, contribuindo para a redução de falhas operacionais.

Libâneo (2018) destaca que a organização escolar depende de processos bem definidos e da adequada distribuição de responsabilidades entre os profissionais envolvidos. Os sistemas de gestão auxiliam nesse processo ao estabelecer fluxos organizados de informação e comunicação.

Além disso, a digitalização dos registros acadêmicos contribui para a preservação histórica das informações e facilita o acesso a documentos importantes para a gestão institucional.

A crescente complexidade das atividades administrativas realizadas pelas instituições de ensino torna indispensável a utilização de ferramentas tecnológicas capazes de centralizar informações e automatizar processos. Matrículas, lançamento de notas, controle de frequência, emissão de relatórios e acompanhamento do desempenho dos estudantes são atividades que demandam grande volume de dados e exigem elevado grau de organização.

Nesse contexto, os sistemas de informação assumem papel estratégico ao fornecer mecanismos que tornam essas operações mais rápidas, precisas e confiáveis.

De acordo com Lahm et al. (2020), os sistemas de informação voltados para a gestão educacional contribuem significativamente para a melhoria dos processos administrativos e pedagógicos, permitindo que gestores tenham acesso a informações atualizadas para apoiar a tomada de decisões.

A disponibilidade de dados em tempo real favorece o planejamento institucional e possibilita a identificação mais rápida de problemas que possam comprometer o desempenho acadêmico ou administrativo da instituição.

Outro aspecto relevante está relacionado à comunicação entre os diferentes membros da comunidade escolar. A utilização de plataformas digitais facilita a troca de informações entre gestores, professores, alunos e responsáveis, promovendo maior integração entre os envolvidos no processo educacional.

Essa comunicação mais eficiente contribui para o acompanhamento do desempenho dos estudantes e fortalece a participação da comunidade nas atividades escolares.

A adoção de sistemas informatizados também proporciona ganhos relacionados à transparência e à confiabilidade das informações. Com registros armazenados em ambiente digital, torna-se possível reduzir erros decorrentes de processos manuais, minimizar inconsistências nos dados e garantir maior rastreabilidade das operações realizadas.

Segundo Elmasri e Navathe (2019), a utilização de bancos de dados estruturados permite manter a integridade das informações, assegurando que os registros permaneçam consistentes e disponíveis para consulta quando necessário.

Além disso, a integração entre sistemas de gestão e tecnologias de computação em nuvem amplia ainda mais os benefícios da transformação digital nas instituições de ensino.

Conforme destacam Souza et al. (2023), as soluções baseadas em nuvem oferecem maior disponibilidade, escalabilidade e segurança para o armazenamento das informações, permitindo que dados acadêmicos sejam acessados de forma remota por usuários autorizados.

Essa característica favorece a mobilidade e amplia a eficiência dos processos administrativos e pedagógicos.

A modernização da gestão escolar também está associada à capacidade de utilizar informações para apoiar decisões estratégicas. Relatórios gerenciais, indicadores de desempenho, estatísticas de frequência e análises acadêmicas podem ser gerados automaticamente pelos sistemas, fornecendo subsídios para o planejamento institucional.

Dessa forma, gestores passam a atuar de maneira mais orientada por dados, reduzindo a subjetividade das decisões e aumentando a eficiência na utilização dos recursos disponíveis.

Outro benefício proporcionado pela digitalização dos processos escolares refere-se à sustentabilidade organizacional. A substituição gradual de documentos físicos por registros eletrônicos reduz o consumo de papel, otimiza o espaço destinado ao arquivamento de documentos e simplifica a recuperação das informações.

Essa prática está alinhada às tendências contemporâneas de gestão sustentável e de transformação digital das organizações.

Diante desse cenário, observa-se que a utilização de tecnologias da informação tornou-se um elemento fundamental para a gestão escolar contemporânea.

Mais do que automatizar tarefas administrativas, os sistemas de gestão contribuem para a melhoria da qualidade dos serviços educacionais, fortalecem os processos organizacionais e oferecem suporte à tomada de decisões.

Assim, a adoção de soluções tecnológicas representa uma estratégia importante para que as instituições de ensino atendam às exigências de um ambiente educacional cada vez mais dinâmico, conectado e orientado pela informação.

# SEGURANÇA DA INFORMAÇÃO EM SISTEMAS ESCOLARES

O crescimento da utilização de tecnologias digitais também aumenta a necessidade de proteção das informações armazenadas pelas instituições de ensino. Dados acadêmicos, informações pessoais e registros administrativos devem ser protegidos contra acessos não autorizados, perdas e alterações indevidas.

Segundo Stallings (2018), a segurança da informação baseia-se em três princípios fundamentais: confidencialidade, integridade e disponibilidade. Esses princípios garantem que as informações sejam acessadas apenas por usuários autorizados, permaneçam corretas e estejam disponíveis quando necessário.

No contexto do sistema proposto, foram adotadas medidas como criptografia de senhas, utilização de algoritmos hash, controle de permissões de acesso e realização periódica de backups.

A implementação desses mecanismos contribui para aumentar a confiabilidade da plataforma e reduzir riscos relacionados à segurança digital.

A criptografia desempenha papel fundamental na proteção das informações sensíveis armazenadas e transmitidas pelo sistema. De acordo com Stallings (2018), os mecanismos criptográficos permitem transformar dados legíveis em informações codificadas, dificultando o acesso por indivíduos não autorizados.

Dessa forma, mesmo que ocorra a interceptação dos dados durante a transmissão ou o acesso indevido ao banco de dados, as informações permanecem protegidas.

Além da criptografia, a utilização de funções hash para o armazenamento de senhas constitui uma das práticas mais recomendadas no desenvolvimento de sistemas modernos.

Diferentemente da criptografia convencional, o hash é um processo unidirecional que converte a senha em uma sequência de caracteres impossível de ser revertida diretamente ao seu valor original.

Essa abordagem aumenta significativamente a proteção das credenciais dos usuários, reduzindo os impactos de possíveis vazamentos de dados.

Outro aspecto importante refere-se ao controle de acesso baseado em perfis de usuário.

Em sistemas escolares, diferentes usuários possuem necessidades distintas de acesso às informações. Administradores, professores e alunos devem visualizar apenas os recursos compatíveis com suas atribuições.

Segundo Pressman e Maxim (2021), a definição adequada de permissões é uma prática essencial para minimizar vulnerabilidades e restringir o acesso a informações críticas da aplicação.

A preocupação com a segurança também está relacionada à proteção contra ameaças presentes em aplicações web.

A OWASP Foundation (2021) destaca que vulnerabilidades como falhas de autenticação, exposição de dados sensíveis, injeção de comandos e configurações inadequadas de segurança estão entre os principais riscos enfrentados pelos sistemas modernos.

Por esse motivo, durante o desenvolvimento da plataforma foram adotadas boas práticas de programação e validação de dados, buscando reduzir a possibilidade de exploração dessas vulnerabilidades.

Outro mecanismo essencial para garantir a proteção das informações consiste na realização de backups periódicos.

Conforme destacam Souza et al. (2023), os ambientes de computação em nuvem oferecem recursos automatizados de cópia e recuperação de dados, permitindo restaurar informações em situações de falhas técnicas, exclusões acidentais ou incidentes de segurança.

Essa característica aumenta a disponibilidade dos serviços e reduz significativamente os riscos de perda permanente de dados.

Além dos aspectos técnicos, a proteção das informações deve observar as exigências legais relacionadas ao tratamento de dados pessoais.

No Brasil, a Lei Geral de Proteção de Dados Pessoais (LGPD), instituída pela Lei nº 13.709/2018, estabelece princípios e diretrizes para a coleta, armazenamento e utilização de dados pessoais.

A legislação determina que organizações adotem medidas de segurança adequadas para proteger as informações dos usuários, garantindo transparência, privacidade e responsabilidade no tratamento dos dados.

No ambiente educacional, o cumprimento dessas diretrizes torna-se ainda mais relevante devido ao grande volume de informações pessoais e acadêmicas armazenadas pelas instituições de ensino.

Dessa forma, a adoção de mecanismos de segurança, aliada à observância das normas legais vigentes, contribui para a construção de sistemas mais confiáveis, protegidos e alinhados às necessidades da transformação digital na educação.

Portanto, a segurança da informação deve ser compreendida como um elemento estratégico para o desenvolvimento de sistemas escolares.

A combinação de criptografia, autenticação segura, controle de acesso, backups automatizados, monitoramento e conformidade com a LGPD permite criar um ambiente digital capaz de proteger os dados institucionais e garantir maior confiança aos usuários da plataforma.

# ARQUITETURA E DESENVOLVIMENTO DO SISTEMA PROPOSTO

O desenvolvimento de sistemas acadêmicos exige planejamento adequado da arquitetura de software. Segundo Pressman e Maxim (2021), uma arquitetura bem estruturada facilita a manutenção, a escalabilidade e a evolução futura do sistema.

O projeto desenvolvido utiliza tecnologias amplamente difundidas no mercado, incluindo PHP, JavaScript, Python e banco de dados hospedado em ambiente de nuvem. Essa combinação permite criar uma plataforma moderna, acessível e preparada para futuras expansões.

Entre as funcionalidades implementadas encontram-se:

- Cadastro de usuários;
- Gerenciamento de turmas;
- Controle de notas;
- Acompanhamento de frequência;
- Autenticação segura;
- Integração com banco de dados centralizado.

A arquitetura adotada possibilita futuras integrações com aplicativos móveis, sistemas de comunicação escolar e ferramentas de análise de dados, ampliando o potencial de utilização da plataforma.

Dessa forma, o sistema desenvolvido busca atender às necessidades atuais das instituições de ensino, oferecendo uma solução tecnológica alinhada às tendências da transformação digital e da computação em nuvem.

Segundo Pressman e Maxim (2021), o sucesso de um sistema de software está diretamente relacionado à qualidade de sua arquitetura, uma vez que ela define a organização dos componentes, a comunicação entre os módulos e a capacidade de adaptação às mudanças futuras.

Com base nesse princípio, o sistema foi projetado de forma modular, permitindo que novas funcionalidades sejam incorporadas sem comprometer a estrutura já existente.

Essa característica favorece a manutenção do código e reduz os custos relacionados a futuras atualizações.

A utilização da linguagem PHP no desenvolvimento do sistema contribui para a construção de aplicações web dinâmicas e compatíveis com diferentes ambientes de hospedagem.

Conforme a documentação oficial do PHP Group (2025), a linguagem oferece recursos robustos para integração com bancos de dados, gerenciamento de sessões, autenticação de usuários e desenvolvimento de aplicações escaláveis.

Associado ao JavaScript, responsável pela interação dinâmica das interfaces, o sistema proporciona uma experiência mais fluida e intuitiva aos usuários.

O emprego da linguagem Python complementa a arquitetura do sistema ao possibilitar futuras implementações relacionadas à automação de processos, geração de relatórios avançados e análise de dados acadêmicos.

Essa flexibilidade tecnológica amplia as possibilidades de evolução da plataforma e acompanha as tendências atuais de desenvolvimento de software orientado a dados.

No que se refere ao gerenciamento das informações, a integração com bancos de dados em nuvem proporciona maior disponibilidade, segurança e escalabilidade.

De acordo com Souza et al. (2023), a utilização de ambientes em nuvem permite que os recursos computacionais sejam ajustados conforme a demanda, garantindo melhor desempenho mesmo em períodos de grande utilização do sistema.

Além disso, os mecanismos automatizados de backup e recuperação de dados aumentam a confiabilidade da aplicação e reduzem os riscos associados à perda de informações.

Outro aspecto relevante da arquitetura adotada é a separação entre a camada de apresentação, responsável pela interface com o usuário, a camada de processamento das regras de negócio e a camada de persistência de dados.

Essa organização segue boas práticas de engenharia de software e favorece a reutilização de componentes, a manutenção do código e a escalabilidade da aplicação.

Segundo Elmasri e Navathe (2019), a correta separação das responsabilidades entre os componentes do sistema contribui para melhorar o desempenho e a consistência das operações realizadas sobre os dados.

A segurança também foi considerada desde as etapas iniciais do desenvolvimento.

Além da implementação de autenticação de usuários e criptografia de senhas, foram aplicadas práticas recomendadas pela OWASP Foundation (2021), incluindo:

- Validação de entradas de dados;
- Controle de sessões;
- Restrição de acessos baseada em perfis de usuário.

Essas medidas visam minimizar vulnerabilidades comuns em aplicações web e aumentar a proteção das informações acadêmicas armazenadas.

No contexto educacional, a adoção de sistemas informatizados contribui significativamente para a melhoria dos processos de gestão.

Conforme destacam Lahm et al. (2020), os sistemas de informação educacional possibilitam maior agilidade no tratamento dos dados acadêmicos, favorecendo a organização institucional e a tomada de decisões.

Dessa forma, a plataforma desenvolvida busca não apenas automatizar tarefas administrativas, mas também fornecer uma base tecnológica capaz de apoiar o gerenciamento estratégico das instituições de ensino.

Adicionalmente, a arquitetura implementada foi concebida considerando princípios de acessibilidade, usabilidade e responsividade.

Isso permite que o sistema seja utilizado em diferentes dispositivos, como:

- Computadores;
- Tablets;
- Smartphones.

Essa característica amplia o alcance da plataforma e facilita o acesso às informações por parte de gestores, professores e estudantes.

Tal abordagem está alinhada às demandas atuais da educação digital, que exige ambientes cada vez mais flexíveis e acessíveis.

Portanto, a arquitetura de software adotada representa um elemento fundamental para o sucesso do sistema escolar proposto.

A combinação de tecnologias modernas, integração com banco de dados em nuvem, mecanismos de segurança, estrutura modular e possibilidade de expansão futura proporciona uma solução robusta e eficiente para a gestão acadêmica.

Além de atender às necessidades atuais das instituições de ensino, o sistema apresenta potencial para incorporar novos recursos e acompanhar a evolução tecnológica do setor educacional nos próximos anos.

# CONSIDERAÇÕES FINAIS

O desenvolvimento deste trabalho permitiu compreender a importância da computação em nuvem e dos sistemas de informação para a modernização da gestão educacional.

A pesquisa demonstrou que a utilização de tecnologias baseadas em nuvem oferece benefícios significativos para instituições de ensino, especialmente no que se refere ao armazenamento seguro de dados, à acessibilidade das informações e à otimização dos processos administrativos e acadêmicos.

A análise dos conceitos apresentados evidenciou que os bancos de dados em nuvem representam uma solução eficiente para o gerenciamento de informações escolares, possibilitando maior organização, disponibilidade e integração dos dados.

Além disso, verificou-se que a adoção de sistemas informatizados contribui para a redução de atividades manuais, melhora a comunicação entre os diferentes usuários da plataforma e fornece informações relevantes para a tomada de decisões por parte dos gestores.

Outro aspecto relevante observado durante o desenvolvimento do projeto foi a necessidade de garantir a segurança das informações armazenadas.

A implementação de mecanismos como autenticação de usuários, criptografia de senhas, controle de permissões e rotinas de backup mostrou-se fundamental para assegurar a proteção dos dados acadêmicos e a confiabilidade do sistema.

Em relação ao sistema proposto, os resultados obtidos demonstram que a utilização de tecnologias como PHP, JavaScript, Python e banco de dados em nuvem possibilitou a construção de uma plataforma funcional, capaz de atender às principais demandas da gestão escolar.

As funcionalidades implementadas permitem o gerenciamento de usuários, turmas, notas e frequência de forma centralizada, contribuindo para uma administração mais eficiente e organizada.

Adicionalmente, observou-se que a arquitetura adotada no desenvolvimento do sistema favorece a escalabilidade e a manutenção da aplicação, permitindo que novas funcionalidades sejam incorporadas sem a necessidade de grandes reestruturações.

Esse aspecto é fundamental em sistemas educacionais, uma vez que as demandas institucionais tendem a evoluir ao longo do tempo, exigindo adaptações constantes da plataforma para acompanhar novas práticas pedagógicas e administrativas.

Outro ponto importante identificado refere-se à melhoria na disponibilidade e no acesso às informações.

A utilização de banco de dados em nuvem possibilita que os dados acadêmicos estejam acessíveis em tempo real para usuários autorizados, independentemente de sua localização geográfica.

Essa característica contribui para maior flexibilidade no uso do sistema, especialmente em contextos de ensino híbrido ou remoto, nos quais o acesso rápido e seguro às informações é essencial.

Também se destaca o impacto positivo da digitalização dos processos escolares na redução de erros operacionais.

A substituição de registros manuais por sistemas automatizados diminui a ocorrência de inconsistências nos dados, como duplicidade de informações ou falhas no lançamento de notas e frequência.

Conforme apontado por Elmasri e Navathe (2019), a estruturação adequada dos bancos de dados contribui diretamente para a integridade e confiabilidade das informações armazenadas, reforçando a importância da modelagem correta no desenvolvimento de sistemas de informação.

No contexto da segurança da informação, reforça-se a importância da adoção de boas práticas no desenvolvimento de sistemas web, conforme destacado pela OWASP Foundation (2021).

A aplicação de mecanismos de proteção contra vulnerabilidades comuns, aliada ao uso de técnicas de criptografia e controle de acesso, contribui significativamente para a redução de riscos e para a proteção dos dados sensíveis dos usuários.

Além disso, a observância das diretrizes estabelecidas pela Lei Geral de Proteção de Dados (BRASIL, 2018) reforça o compromisso com a privacidade e o uso responsável das informações pessoais.

Dessa forma, o sistema desenvolvido não apenas atende às necessidades funcionais da gestão escolar, mas também incorpora princípios fundamentais de segurança, organização e eficiência.

A integração entre diferentes tecnologias e conceitos da engenharia de software possibilitou a construção de uma solução consistente e alinhada às demandas contemporâneas da educação digital.

Por fim, conclui-se que a integração entre computação em nuvem, bancos de dados e sistemas de informação representa uma alternativa viável e estratégica para instituições de ensino que buscam acompanhar as transformações tecnológicas da sociedade contemporânea.

Como trabalhos futuros, recomenda-se a ampliação das funcionalidades do sistema, incluindo:

- Desenvolvimento de aplicativos móveis;
- Implementação de recursos de análise de dados educacionais;
- Integração com outras plataformas acadêmicas.

Essas melhorias visam ampliar ainda mais sua eficiência e aplicabilidade.

Além disso, sugere-se a realização de testes com usuários reais em ambiente escolar, a fim de avaliar a usabilidade, o desempenho e o impacto prático da solução proposta, permitindo melhorias contínuas no sistema.

# REFERÊNCIAS

BRASIL. **Lei nº 13.709, de 14 de agosto de 2018. Lei Geral de Proteção de Dados Pessoais (LGPD).** Brasília, DF: Presidência da República, 2018. Disponível em: https://www.planalto.gov.br. Acesso em: 14 jun. 2026.

ELMASRI, Ramez; NAVATHE, Shamkant B. **Sistemas de Banco de Dados.** 7. ed. São Paulo: Pearson Education do Brasil, 2019.

LAHM, Rosane Andréa et al. **Sistemas de Informação para Gestão Educacional.** Santa Maria: Universidade Federal de Santa Maria, 2020. Disponível em: https://repositorio.ufsm.br. Acesso em: 14 jun. 2026.

LIBÂNEO, José Carlos. **Organização e Gestão da Escola: Teoria e Prática.** 6. ed. São Paulo: Heccus Editora, 2018.

LIMA, Luiz Vieira et al. **Uma Abordagem de Arquitetura em Nuvem para Dados Educacionais.** Uberlândia: Universidade Federal de Uberlândia, 2022. Disponível em: https://repositorio.ufu.br. Acesso em: 14 jun. 2026.

LÜCK, Heloísa. **Dimensões da Gestão Escolar e suas Competências.** Curitiba: Positivo, 2009.

MORGADO, Edson Martins; TÁVORA, Carlos Gomes. **A Computação na Nuvem e o B-Learning.** Revista Contemporânea, v. 3, n. 8, p. 145–162, 2023. Disponível em: https://ojs.revistacontemporanea.com. Acesso em: 14 jun. 2026.

OWASP FOUNDATION. **OWASP Top 10: The Ten Most Critical Web Application Security Risks.** 2021. Disponível em: https://owasp.org. Acesso em: 14 jun. 2026.

PHP GROUP. **PHP Documentation.** 2025. Disponível em: https://www.php.net/docs.php. Acesso em: 14 jun. 2026.

PRESSMAN, Roger S.; MAXIM, Bruce R. **Engenharia de Software: Uma Abordagem Profissional.** 9. ed. Porto Alegre: AMGH, 2021.

SANTOS, Jonathan César Reis dos. **Desenvolvimento de Sistemas: Software GestorEdu.** 2022. Trabalho de Conclusão de Curso (Bacharelado em Sistemas para Internet) – Instituto Federal da Paraíba, João Pessoa, 2022.

SOUZA, João et al. **Gerenciamento de Dados em Nuvem: Conceitos, Sistemas e Desafios.** Porto Alegre: Sociedade Brasileira de Computação, 2023. Disponível em: https://books-sol.sbc.org.br. Acesso em: 14 jun. 2026.

STALLINGS, William. **Criptografia e Segurança de Redes: Princípios e Práticas.** 7. ed. São Paulo: Pearson Education do Brasil, 2018.
