@extends('layouts.app')

@section('title', 'Mostra de cinema portugués da Ribeira Sacra')

@section('content')
	<x-header :$edition
		:$splash
		height="tall"
		third-line="Ribeira Sacra"
		:title="$edition->title" />

	<main>
		<section class="text-lg text-gray-950 text-pretty my-16 xl:my-24">

			<div class="w-full px-6 max-w-7xl mx-auto md:columns-2 md:gap-12 xl:columns-3 space-y-6">
				<h2 class="font-semibold text-xl">Sobre a mostra</h2>

				<p>Vendaval é un sopro de aire morno, unha ventada amiga procedente do Sur. Vendaval é a mostra de cinema de Portugal, na Ribeira Sacra.</p>

				<p>One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment.</p>

				<p>His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What's happened to me? " he thought. It wasn't a dream. His room, a proper human room although a little too small, lay peacefully between its four familiar walls.</p>

				<p>A collection of textile samples lay spread out on the table &mdash;Samsa was a travelling salesman&mdash; and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame. It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer.</p>

				<p>Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad. "How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn't get into that position. However hard he threw himself onto his right, he always rolled back to where he was. He must have tried it a hundred times, shut his eyes so that he wouldn't have to look at the floundering legs, and only stopped when</p>
			</div>
		</section>
	</main>
@endsection
